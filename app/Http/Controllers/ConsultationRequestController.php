<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequestRequest;
use App\Mail\ConsultationRequestSubmitted;
use App\Models\ConsultationRequest;
use App\Models\VisaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ConsultationRequestController extends Controller
{
    /**
     * Show the consultation request form.
     */
    public function create(?string $slug = null): View
    {
        $visaService = null;
        if ($slug) {
            $visaService = VisaService::where('slug', $slug)
                ->where('is_active', true)
                ->first();
        }

        $visaServices = VisaService::active()->get();

        return view('consultation-requests.create', compact('visaService', 'visaServices'));
    }

    /**
     * Store a newly created consultation request.
     */
    public function store(StoreConsultationRequestRequest $request): RedirectResponse
    {
        $consultationRequest = ConsultationRequest::create([
            ...$request->validated(),
            'status' => 'pending',
        ]);

        // Load the visa service relationship for the email
        $consultationRequest->load('visaService');

        // Send notification email to admin
        $adminEmail = config('mail.admin_email', config('mail.from.address'));
        Mail::to($adminEmail)->send(new ConsultationRequestSubmitted($consultationRequest));

        $redirectRoute = $consultationRequest->visa_service_id
            ? route('visa-services.show', $consultationRequest->visaService->slug)
            : route('visa-services.index');

        return redirect($redirectRoute)
            ->with('success', __('Your consultation request has been submitted successfully. We will contact you soon.'));
    }
}
