@once
<style>
    /* Testimonial Carousel Container */
    .testimonial-carousel-wrapper {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        padding: 1.15rem 0 1.25rem;
    }

    .testimonial-carousel-container {
        overflow: hidden;
        width: 100%;
        border-radius: 0;
        position: relative;
        padding-inline: clamp(0.65rem, 2.8vw, 2.2rem);
    }

    .testimonial-fade {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 60px;
        pointer-events: none;
        z-index: 10;
    }

    .testimonial-fade-left {
        left: 0;
        background: linear-gradient(to right, #f8f7f4 0%, transparent 100%);
    }

    .testimonial-fade-right {
        right: 0;
        background: linear-gradient(to left, #f8f7f4 0%, transparent 100%);
    }

    .testimonial-carousel-track {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        will-change: transform;
        padding: 0.4rem 0;
    }

    .testimonial-summary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: rgba(180, 35, 24, 0.06);
        color: #5a1f18;
        border-radius: 999px;
        padding: 0.35rem 0.75rem;
        font-size: 0.78rem;
        font-weight: 600;
    }

    .testimonial-summary-stars {
        display: inline-flex;
        align-items: center;
        gap: 0.1rem;
        color: #b42318;
        font-size: 0.9rem;
        line-height: 1;
        letter-spacing: 0;
    }

    .testimonial-summary-text {
        white-space: nowrap;
        line-height: 1.15;
        font-size: 0.78rem;
    }

    /* Responsive animation speed */
    @media (max-width: 768px) {
        .testimonial-summary {
            padding: 0.54rem 0.86rem;
            font-size: 0.82rem;
            margin-bottom: 0.8rem;
        }

        .testimonial-summary-stars {
            font-size: 0.98rem;
        }

        .testimonial-summary-text {
            font-size: 0.8rem;
        }

        .testimonial-carousel-track {
            gap: 0.82rem;
        }
    }

    @media (max-width: 640px) {
        .testimonial-summary {
            width: calc(100% - 1rem);
            max-width: 420px;
            justify-content: center;
            gap: 0.42rem;
            padding: 0.5rem 0.72rem;
            margin-bottom: 0.7rem;
        }

        .testimonial-summary-stars {
            font-size: 0.9rem;
        }

        .testimonial-summary-text {
            font-size: 0.74rem;
            text-align: center;
        }

        .testimonial-carousel-track {
            gap: 0.65rem;
        }

        .testimonial-carousel-wrapper {
            padding: 0.86rem 0;
        }

        .testimonial-carousel-container {
            padding-inline: 0.6rem;
        }
    }

    /* Testimonial Card Styles */
    .testimonial-card {
        flex: 0 0 420px;
        min-width: 420px;
        background: #f7f7f9;
        padding: 0.96rem 1.04rem 0.92rem;
        border-radius: 1.1rem;
        box-shadow: inset 0 0 0 1px rgba(26, 22, 18, 0.04);
        border: 1px solid rgba(30, 22, 16, 0.03);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 206px;
        position: relative;
        overflow: hidden;
    }

    .testimonial-card.is-expanded {
        height: auto;
        min-height: 206px;
    }

    .testimonial-card-content {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .testimonial-card-top {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-bottom: 0.38rem;
    }

    .testimonial-card-date {
        display: inline-flex;
        align-items: center;
        gap: 0.22rem;
        font-size: 0.62rem;
        font-weight: 700;
        color: #8d97a6;
        letter-spacing: 0.02em;
        text-transform: lowercase;
    }

    .testimonial-card-date i {
        color: #a7afbc;
        font-size: 0.66rem;
    }

    /* Header dengan nama dan rating */
    .testimonial-card-header {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-top: 0.22rem;
        margin-bottom: 0.55rem;
        gap: 0.56rem;
    }

    .testimonial-card-name {
        font-weight: 500;
        font-size: 0.8rem;
        color: #1f2430;
        line-height: 1.34;
        flex: 1;
        padding-right: 4.4rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        white-space: normal;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .testimonial-card-rating {
        color: #f59e0b;
        font-size: 0.97rem;
        font-weight: 700;
        white-space: nowrap;
        letter-spacing: 0.01em;
        position: absolute;
        top: 0.02rem;
        right: 0.02rem;
        line-height: 1;
    }

    /* Review text dengan clamping */
    .testimonial-card-spacer {
        flex: 1;
        min-height: 0.42rem;
    }

    .testimonial-admin-reply {
        margin-bottom: 0.52rem;
        background: #f0f2f5;
        border: 1px solid rgba(31, 36, 48, 0.06);
        border-radius: 0.62rem;
        padding: 0.48rem 0.54rem 0.46rem;
        color: #1f2430;
    }

    .testimonial-admin-reply-head {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.78rem;
        font-weight: 800;
        margin-bottom: 0.28rem;
        color: #1f2430;
    }

    .testimonial-admin-reply-head i {
        color: #d5302c;
        font-size: 0.8rem;
    }

    .testimonial-admin-reply-text {
        margin: 0;
        font-size: 0.78rem;
        color: #9198a4;
        font-style: italic;
        line-height: 1.45;
        white-space: pre-wrap;
    }

    .testimonial-admin-reply-toggle {
        appearance: none;
        border: none;
        background: transparent;
        color: #273142;
        font-size: 0.72rem;
        font-weight: 700;
        text-decoration: underline;
        text-underline-offset: 2px;
        cursor: pointer;
        padding: 0;
        margin-top: 0.3rem;
    }

    .testimonial-admin-reply-toggle:hover {
        color: #141b27;
    }

    /* Footer dengan identitas pelanggan */
    .testimonial-card-footer {
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 0.52rem;
        border-top: none;
        padding-top: 0;
    }

    .testimonial-avatar {
        width: 36px;
        height: 36px;
        border-radius: 999px;
        background: #f1dfe1;
        color: #c22723;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        font-weight: 700;
        text-transform: lowercase;
        flex-shrink: 0;
    }

    .testimonial-card-user {
        min-width: 0;
    }

    .testimonial-user-name {
        font-size: 0.98rem;
        font-weight: 800;
        line-height: 1.06;
        color: #1f2430;
        margin-bottom: 0.08rem;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .testimonial-user-meta {
        font-size: 0.64rem;
        color: #9dadc4;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .testimonial-google-link-wrap {
        display: flex;
        justify-content: center;
        margin-top: 0.92rem;
    }

    .testimonial-google-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.42rem;
        padding: 0.58rem 1rem;
        background: #f8f7f4;
        border-radius: 999px;
        border: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 2px 0 rgba(0, 0, 0, 0.03);
        color: #1f2430;
        font-size: 0.82rem;
        font-weight: 700;
        text-decoration: none;
    }

    .testimonial-google-link i {
        color: #de2d2a;
        font-size: 0.94rem;
    }

    .testimonial-google-link:hover {
        color: #131924;
        border-color: rgba(0, 0, 0, 0.14);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .testimonial-card {
            flex: 0 0 360px;
            min-width: 360px;
            padding: 0.86rem;
            height: 196px;
        }

        .testimonial-card.is-expanded {
            height: auto;
            min-height: 196px;
        }

        .testimonial-card-top {
            margin-bottom: 0.3rem;
        }

        .testimonial-card-date {
            font-size: 0.58rem;
        }

        .testimonial-card-date i {
            font-size: 0.6rem;
        }

        .testimonial-card-name {
            font-size: 0.76rem;
            padding-right: 3.9rem;
        }

        .testimonial-card-rating {
            font-size: 0.88rem;
            top: 0;
            right: 0;
        }

        .testimonial-avatar {
            width: 34px;
            height: 34px;
            font-size: 0.92rem;
        }

        .testimonial-user-name {
            font-size: 0.9rem;
        }

        .testimonial-user-meta {
            font-size: 0.6rem;
        }

        .testimonial-google-link {
            font-size: 0.78rem;
            padding: 0.52rem 0.92rem;
        }

        .testimonial-google-link i {
            font-size: 0.88rem;
        }
    }

    @media (max-width: 640px) {
        .testimonial-card {
            flex: 0 0 calc(100vw - 2.1rem);
            min-width: calc(100vw - 2.1rem);
            max-width: 360px;
            padding: 0.84rem;
            border-radius: 1rem;
            height: 180px;
        }

        .testimonial-card.is-expanded {
            height: auto;
            min-height: 180px;
        }

        .testimonial-card-top {
            margin-bottom: 0.24rem;
        }

        .testimonial-card-date {
            font-size: 0.54rem;
        }

        .testimonial-card-date i {
            font-size: 0.56rem;
        }

        .testimonial-card-name {
            font-size: 0.72rem;
            padding-right: 3.45rem;
        }

        .testimonial-card-header {
            margin-bottom: 0.5rem;
            gap: 0.36rem;
        }

        .testimonial-card-rating {
            font-size: 0.82rem;
            top: 0;
            right: 0;
        }

        .testimonial-admin-reply {
            margin-bottom: 0.56rem;
            padding: 0.5rem;
            border-radius: 0.62rem;
        }

        .testimonial-admin-reply-head {
            font-size: 0.72rem;
            margin-bottom: 0.22rem;
        }

        .testimonial-admin-reply-head i {
            font-size: 0.7rem;
        }

        .testimonial-admin-reply-text {
            font-size: 0.7rem;
        }

        .testimonial-admin-reply-toggle {
            font-size: 0.66rem;
            margin-top: 0.28rem;
        }

        .testimonial-avatar {
            width: 31px;
            height: 31px;
            font-size: 0.8rem;
        }

        .testimonial-user-name {
            font-size: 0.8rem;
            margin-bottom: 0.06rem;
        }

        .testimonial-user-meta {
            font-size: 0.56rem;
            letter-spacing: 0.06em;
        }

        .testimonial-google-link-wrap {
            margin-top: 0.68rem;
        }

        .testimonial-google-link {
            width: calc(100% - 1rem);
            max-width: 320px;
            padding: 0.5rem 0.72rem;
            font-size: 0.74rem;
            gap: 0.35rem;
        }

        .testimonial-google-link i {
            font-size: 0.82rem;
        }
    }

    /* Smooth transition for added elements */
    .testimonial-card:nth-child(n) {
        opacity: 1;
        transition: opacity 0.3s ease;
    }

    /* Empty state */
    .testimonial-empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        color: #5c4637;
    }

    .testimonial-empty-state-icon {
        font-size: 3rem;
        color: #d1d5db;
        margin-bottom: 1rem;
        display: block;
    }

    .testimonial-empty-state-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #3a2a1a;
        margin-bottom: 0.5rem;
    }

    .testimonial-empty-state-text {
        font-size: 0.875rem;
        color: #8b7355;
    }
</style>

@include('partials.review-readmore')

<div class="testimonial-carousel-wrapper">
    @if(isset($testimonials) && $testimonials->count() > 0)
        @php
            $reviewCount = $testimonials->count();
            $averageRating = number_format((float) ($testimonials->avg('rating') ?? 0), 1);
            $roundedRating = (int) round((float) ($testimonials->avg('rating') ?? 0));
        @endphp

        <div class="text-center mb-8">
            <div class="testimonial-summary" aria-label="Ringkasan rating pelanggan">
                <span class="testimonial-summary-stars" aria-hidden="true">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $roundedRating)★@else☆@endif
                    @endfor
                </span>
                <span class="testimonial-summary-text">Rata-rata {{ $averageRating }}/5 dari {{ $reviewCount }} ulasan</span>
            </div>
        </div>

        <div class="testimonial-carousel-container" id="testimonialCarousel">
            <div class="testimonial-fade testimonial-fade-left" aria-hidden="true"></div>
            <div class="testimonial-fade testimonial-fade-right" aria-hidden="true"></div>
            <div class="testimonial-carousel-track" id="testimonialTrack">
                <!-- Cards will be duplicated by JavaScript for seamless loop -->
                @foreach($testimonials as $testimonial)
                    <div class="testimonial-card" data-testimonial-id="{{ $testimonial->id }}">
                        <div class="testimonial-card-content">
                            <div class="testimonial-card-top">
                                <div class="testimonial-card-date" aria-label="Waktu ulasan">
                                    <i class="far fa-clock" aria-hidden="true"></i>
                                    {{ optional($testimonial->created_at)->copy()->locale('en')->diffForHumans() ?? 'just now' }}
                                </div>
                            </div>

                            <div class="testimonial-card-header">
                                <div class="testimonial-card-name">&ldquo;{{ $testimonial->content }}&rdquo;</div>
                                <div class="testimonial-card-rating">
                                    @for($i = 0; $i < 5; $i++)
                                        @if($i < $testimonial->rating)★@else☆@endif
                                    @endfor
                                </div>
                            </div>

                            @if(!empty($testimonial->admin_reply))
                                <div class="testimonial-admin-reply" data-review-block>
                                    <div class="testimonial-admin-reply-head">
                                        <i class="fas fa-circle-check" aria-hidden="true"></i>
                                        Balasan Admin:
                                    </div>
                                    <p
                                        class="testimonial-admin-reply-text"
                                        data-review-text
                                        data-clamp-lines="1"
                                        style="--review-fade-bg: #f0f2f5;"
                                    >{{ $testimonial->admin_reply }}</p>
                                    <button type="button" class="testimonial-admin-reply-toggle" data-toggle-text>Lihat selengkapnya</button>
                                </div>
                            @endif

                            <div class="testimonial-card-spacer" aria-hidden="true"></div>

                            <div class="testimonial-card-footer">
                                <div class="testimonial-avatar" aria-hidden="true">
                                    {{ strtolower(substr(trim($testimonial->customer_name), 0, 1)) }}
                                </div>
                                <div class="testimonial-card-user">
                                    <div class="testimonial-user-name">{{ $testimonial->customer_name }}</div>
                                    <div class="testimonial-user-meta">Pelanggan BBC</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="testimonial-google-link-wrap">
            <a
                class="testimonial-google-link"
                href="https://www.google.com/search?q=Bakso+Bunderan+Ciomas+ulasan"
                target="_blank"
                rel="noopener noreferrer"
            >
                <i class="fab fa-google" aria-hidden="true"></i>
                Baca Ulasan Lainnya di Google
            </a>
        </div>
    @else
        <div class="testimonial-carousel-container">
            <div class="testimonial-empty-state">
                <i class="fas fa-comments testimonial-empty-state-icon"></i>
                <h4 class="testimonial-empty-state-title">Belum Ada Ulasan</h4>
                <p class="testimonial-empty-state-text">Ulasan pelanggan akan ditampilkan di sini setelah ada testimoni masuk.</p>
            </div>
        </div>
    @endif
</div>

<script>
    (function() {
        'use strict';

        function initTestimonialCarousel() {
            const carousel = document.getElementById('testimonialCarousel');
            const track = document.getElementById('testimonialTrack');
            if (!carousel || !track) return;

            const baseItems = Array.from(track.querySelectorAll('.testimonial-card:not([data-testi-clone])'));
            if (baseItems.length <= 0) return;

            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                return;
            }

            let position = 0;
            let loopWidth = 0;
            let stepWidth = 0;
            let rafId = null;
            let isAutoScrolling = true;
            const speed = 0.6;

            function clearClones() {
                track.querySelectorAll('[data-testi-clone="1"]').forEach(el => el.remove());
            }

            function rebuild() {
                clearClones();
                baseItems.forEach(item => {
                    const clone = item.cloneNode(true);
                    clone.setAttribute('data-testi-clone', '1');
                    clone.removeAttribute('data-testimonial-id');
                    track.appendChild(clone);
                });

                if (typeof window.initReviewReadMore === 'function') {
                    window.initReviewReadMore(track);
                }

                const first = track.querySelector('.testimonial-card');
                const gap = parseFloat(getComputedStyle(track).gap || '24') || 24;
                stepWidth = first ? (first.getBoundingClientRect().width + gap) : 320;
                loopWidth = stepWidth * baseItems.length;
                position = ((position % loopWidth) + loopWidth) % loopWidth;
                track.style.transform = `translateX(${-position}px)`;
            }

            function tick() {
                if (loopWidth <= 0) {
                    rafId = requestAnimationFrame(tick);
                    return;
                }

                if (isAutoScrolling) {
                    position += speed;
                    if (position >= loopWidth) {
                        position -= loopWidth;
                    }
                    track.style.transform = `translateX(${-position}px)`;
                }

                rafId = requestAnimationFrame(tick);
            }

            carousel.addEventListener('mouseenter', () => {
                isAutoScrolling = false;
            });

            carousel.addEventListener('mouseleave', () => {
                isAutoScrolling = true;
            });

            window.addEventListener('resize', rebuild);

            rebuild();
            if (!rafId) rafId = requestAnimationFrame(tick);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initTestimonialCarousel);
        } else {
            initTestimonialCarousel();
        }

        const mutationObserver = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                mutation.addedNodes.forEach((node) => {
                    if (node.nodeType === 1) {
                        if (node.id === 'testimonialCarousel' || node.querySelector?.('#testimonialCarousel')) {
                            setTimeout(initTestimonialCarousel, 100);
                        }
                    }
                });
            });
        });

        mutationObserver.observe(document.body, { childList: true, subtree: true });
    })();
</script>
@endonce
