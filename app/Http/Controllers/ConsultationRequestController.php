<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequestRequest;
use App\Models\ConsultationRequest;
use App\Models\VisaService;
use Illuminate\Http\RedirectResponse;
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

        // TODO: Send notification email to admin and applicant

        $redirectRoute = $consultationRequest->visa_service_id
            ? route('visa-services.show', $consultationRequest->visaService->slug)
            : route('visa-services.index');

        return redirect($redirectRoute)
            ->with('success', __('Your consultation request has been submitted successfully. We will contact you soon.'));
    }
}
