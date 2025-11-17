<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <!-- Home Page -->
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- Static Pages -->
    <url>
        <loc>{{ route('courses.index') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>

    <url>
        <loc>{{ route('visa-services.index') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>

    <url>
        <loc>{{ route('news.index') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ route('staff.index') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    <url>
        <loc>{{ route('testimonials.index') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>

    <url>
        <loc>{{ route('faqs.index') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    <url>
        <loc>{{ route('contact.index') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    <!-- Courses -->
    @foreach($courses as $course)
    <url>
        <loc>{{ route('courses.show', $course->slug) }}</loc>
        <lastmod>{{ $course->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    <!-- Visa Services -->
    @foreach($visaServices as $service)
    <url>
        <loc>{{ route('visa-services.show', $service->slug) }}</loc>
        <lastmod>{{ $service->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    <!-- News -->
    @foreach($news as $item)
    <url>
        <loc>{{ route('news.show', $item->slug) }}</loc>
        <lastmod>{{ $item->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

    <!-- Staff -->
    @foreach($staff as $member)
    <url>
        <loc>{{ route('staff.show', $member->slug) }}</loc>
        <lastmod>{{ $member->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    @endforeach
</urlset>
