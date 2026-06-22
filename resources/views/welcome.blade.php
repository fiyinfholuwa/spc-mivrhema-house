<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sexual Purity Conference 2026 – The Power of His Grace</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <style>
        :root {
            --red: #e01d50;
            --red-dark: #b5163f;
            --dark: #111;
            --dark-2: #1a1a1a;
            --gray-100: #f9fafb;
            --gray-200: #f3f4f6;
            --gray-300: #e5e7eb;
            --gray-400: #d1d5db;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --text: #1a1a1a;
            --nav-h: 64px;
            --radius: 10px;
            --shadow: 0 4px 20px rgba(0,0,0,0.07);
            --shadow-lg: 0 12px 40px rgba(0,0,0,0.13);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; -webkit-text-size-adjust: 100%; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            color: var(--text); background: #fff; font-size: 16px; line-height: 1.6;
        }
        img { display: block; max-width: 100%; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        button { font-family: inherit; cursor: pointer; }
        input, select, textarea { font-family: inherit; }

        /* ── NAV ── */
        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            height: var(--nav-h); background: rgba(255,255,255,0.97);
            backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--gray-300);
        }
        .nav-inner {
            max-width: 1200px; margin: 0 auto; padding: 0 2rem;
            height: 100%; display: flex; align-items: center; justify-content: space-between;
        }
        .nav-logo { font-size: 1.15rem; font-weight: 900; color: var(--dark); letter-spacing: -0.5px; }
        .nav-logo span { color: var(--red); }
        .nav-links { display: flex; align-items: center; gap: 2rem; }
        .nav-links a {
            font-size: 0.8rem; font-weight: 700; letter-spacing: 0.5px;
            text-transform: uppercase; color: var(--gray-700); transition: color 0.2s;
        }
        .nav-links a:hover { color: var(--red); }
        .nav-cta {
            background: var(--red) !important; color: #fff !important;
            padding: 0.45rem 1.1rem; border-radius: 6px; transition: background 0.2s !important;
        }
        .nav-cta:hover { background: var(--red-dark) !important; color: #fff !important; }
        .nav-toggle {
            display: none; background: none; border: none;
            font-size: 1.4rem; color: var(--dark); padding: 0.25rem;
        }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            background: linear-gradient(160deg, #0a0305 0%, #1a060d 40%, #2a0d18 70%, #120407 100%);
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            text-align: center; padding: calc(var(--nav-h) + 3rem) 1.5rem 5rem;
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: ''; position: absolute; inset: 0; pointer-events: none;
            background: radial-gradient(ellipse 65% 55% at 50% 45%, rgba(224,29,80,0.22) 0%, transparent 65%);
        }
        .hero::after {
            content: ''; position: absolute; inset: 0; pointer-events: none;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.018'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
        }
        .hero-content { position: relative; z-index: 1; max-width: 860px; width: 100%; }
        .hero-eyebrow {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.9); padding: 8px 18px; border-radius: 50px;
            font-size: 0.75rem; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; margin-bottom: 1.5rem;
        }
        .hero-eyebrow i { color: var(--red); }
        .hero-title {
            font-size: clamp(3rem, 8vw, 6rem); font-weight: 900;
            line-height: 0.95; letter-spacing: -1px; margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffd6e0 0%, #ff6b8a 35%, #e01d50 65%, #c2185b 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .hero-verse {
            color: rgba(255,255,255,0.72); font-size: 1.05rem; line-height: 1.75;
            margin: 0 auto 2rem; max-width: 640px;
        }
        .hero-verse strong { color: rgba(255,255,255,0.95); }
        .hero-actions {
            display: flex; gap: 0.85rem; flex-wrap: wrap;
            justify-content: center; margin-bottom: 2.5rem;
        }
        .btn-primary {
            background: var(--red); color: #fff; border: 2px solid var(--red);
            padding: 0.85rem 1.8rem; border-radius: 8px; font-weight: 700;
            font-size: 0.82rem; letter-spacing: 1px; text-transform: uppercase;
            display: inline-flex; align-items: center; gap: 8px; transition: all 0.25s;
        }
        .btn-primary:hover { background: var(--red-dark); border-color: var(--red-dark); color: #fff; transform: translateY(-2px); box-shadow: 0 10px 28px rgba(224,29,80,0.45); }
        .btn-outline {
            background: transparent; color: #fff; border: 2px solid rgba(255,255,255,0.4);
            padding: 0.85rem 1.8rem; border-radius: 8px; font-weight: 700;
            font-size: 0.82rem; letter-spacing: 1px; text-transform: uppercase;
            display: inline-flex; align-items: center; gap: 8px; transition: all 0.25s;
        }
        .btn-outline:hover { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.7); color: #fff; }
        .hero-perks {
            display: flex; align-items: center; gap: 0.65rem; flex-wrap: wrap;
            justify-content: center;
        }
        .hero-perks .perk {
            display: inline-flex; align-items: center; gap: 6px;
            color: rgba(255,255,255,0.6); font-size: 0.83rem;
        }
        .hero-perks .perk i { color: var(--red); font-size: 0.78rem; }
        .hero-perks .sep { color: rgba(255,255,255,0.25); }
        .hero-scroll {
            position: absolute; bottom: 1.5rem; left: 50%; transform: translateX(-50%);
            display: flex; flex-direction: column; align-items: center; gap: 6px;
            color: rgba(255,255,255,0.28); font-size: 0.68rem; letter-spacing: 2px;
            text-transform: uppercase; z-index: 1;
            animation: bounce 2.2s ease-in-out infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50%       { transform: translateX(-50%) translateY(6px); }
        }

        /* ── STATS ── */
        .stats { padding: 5rem 1.5rem; background: #fff; }
        .stats-inner { max-width: 1020px; margin: 0 auto; }
        .stats-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.5rem; }
        .stat-card { border-radius: var(--radius); padding: 2rem 1.5rem; text-align: center; position: relative; overflow: hidden; }
        .stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; }
        .stat-card.rose   { background: #fff0f4; } .stat-card.rose::before   { background: var(--red); }
        .stat-card.blue   { background: #eff6ff; } .stat-card.blue::before   { background: #3b82f6; }
        .stat-card.purple { background: #f5f0ff; } .stat-card.purple::before { background: #8b5cf6; }
        .stat-num { font-size: 3.5rem; font-weight: 900; line-height: 1; margin-bottom: 0.4rem; }
        .stat-card.rose   .stat-num { color: var(--red); }
        .stat-card.blue   .stat-num { color: #3b82f6; }
        .stat-card.purple .stat-num { color: #8b5cf6; }
        .stat-lbl  { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 0.4rem; }
        .stat-desc { font-size: 0.88rem; color: var(--gray-600); line-height: 1.5; }

        /* ── SHARED SECTION HEADER ── */
        .sec-head { text-align: center; margin-bottom: 2.5rem; }
        .sec-title {
            font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 900;
            line-height: 1.1; margin-bottom: 0.65rem;
        }
        .sec-line { width: 40px; height: 3px; background: var(--red); border-radius: 2px; margin: 0 auto 0.9rem; }
        .sec-sub { color: var(--gray-600); font-size: 0.95rem; max-width: 540px; margin: 0 auto; line-height: 1.65; }

        /* ── ABOUT / BURDEN ── */
        .about { padding: 5rem 1.5rem; background: #fff; border-top: 1px solid var(--gray-200); }
        .about-inner { max-width: 860px; margin: 0 auto; }
        .about-body { font-size: 0.97rem; line-height: 1.78; color: #333; }
        .about-body p { margin-bottom: 1.1rem; }
        .highlight { color: var(--red); font-style: italic; font-weight: 600; }
        .blockquote-card {
            border-left: 4px solid var(--red); background: #fff5f7;
            padding: 1.1rem 1.4rem; border-radius: 0 8px 8px 0; margin: 1.5rem 0;
        }
        .blockquote-card p { color: var(--red); font-weight: 600; font-size: 0.97rem; margin: 0; }
        .phone-link { color: var(--red); font-weight: 700; }
        .verse-box {
            background: #fff5f7; border: 1px solid #ffd6e0;
            border-radius: 8px; padding: 1.4rem 1.75rem; margin: 1.5rem 0; text-align: center;
        }
        .verse-box blockquote { font-style: italic; font-size: 0.95rem; color: #444; margin: 0 0 0.5rem; line-height: 1.65; }
        .verse-ref { color: var(--red); font-weight: 700; font-size: 0.88rem; }
        .sign { margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--gray-300); }
        .sign p { margin-bottom: 0.2rem; font-size: 0.93rem; color: #333; }

        /* ── MISSION ── */
        .mission { padding: 5rem 1.5rem; background: var(--dark-2); }
        .mission .sec-title { color: #fff; }
        .mission .sec-sub   { color: rgba(255,255,255,0.5); }
        .mission-grid {
            display: grid; grid-template-columns: repeat(2,1fr); gap: 1.25rem;
            max-width: 960px; margin: 0 auto;
        }
        .mission-card {
            border-radius: var(--radius); padding: 1.5rem;
            display: flex; gap: 1rem; align-items: flex-start;
        }
        .mission-card.rose   { background: #fff0f4; }
        .mission-card.blue   { background: #eff6ff; }
        .mission-card.purple { background: #f5f0ff; }
        .mission-card.amber  { background: #fffbeb; }
        .m-icon {
            width: 44px; height: 44px; border-radius: 10px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; color: #fff;
        }
        .m-icon.rose   { background: var(--red); }
        .m-icon.blue   { background: #3b82f6; }
        .m-icon.purple { background: #8b5cf6; }
        .m-icon.amber  { background: #f59e0b; }
        .m-body h3 { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 0.4rem; }
        .m-body p  { font-size: 0.88rem; color: #555; line-height: 1.6; }

        /* ── LOGISTICS ── */
        .logistics { padding: 5rem 1.5rem; background: var(--gray-100); }
        .logistics-inner { max-width: 1040px; margin: 0 auto; }
        .logistics-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.25rem; margin-bottom: 1.5rem; }
        .l-card {
            background: #fff; border-radius: var(--radius);
            padding: 1.5rem; border: 1px solid var(--gray-300); box-shadow: var(--shadow);
        }
        .l-icon {
            width: 46px; height: 46px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; margin-bottom: 1rem;
        }
        .l-card.loc   .l-icon { background: #fff0f4; color: var(--red); }
        .l-card.sched .l-icon { background: #eff6ff; color: #3b82f6; }
        .l-card.hotel .l-icon { background: #f5f0ff; color: #8b5cf6; }
        .l-card h3 { font-size: 0.95rem; font-weight: 700; color: var(--dark); margin-bottom: 0.75rem; }
        .l-card .venue  { font-weight: 700; color: var(--dark); font-size: 0.9rem; margin-bottom: 0.3rem; }
        .l-card .detail { color: var(--gray-600); font-size: 0.88rem; line-height: 1.55; }
        .sched-row { margin-bottom: 0.6rem; }
        .sched-row .date { font-weight: 700; color: var(--dark); font-size: 0.9rem; display: block; }
        .sched-row .time { color: var(--gray-600); font-size: 0.84rem; }
        .hotel-phone { color: var(--red); font-weight: 700; font-size: 0.98rem; display: flex; align-items: center; gap: 6px; margin-top: 0.5rem; }
        .directions-box {
            background: var(--dark-2); color: #fff;
            padding: 1.75rem; border-radius: var(--radius);
        }
        .directions-box h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem; }
        .directions-box p  { color: rgba(255,255,255,0.68); font-size: 0.9rem; line-height: 1.65; margin-bottom: 0.75rem; }
        .directions-box p:last-child { margin: 0; }
        .dir-lbl { color: var(--red); font-weight: 700; }

        /* ── PARTNERS ── */
        .partners { padding: 4.5rem 1.5rem; background: #fff; border-top: 1px solid var(--gray-200); }
        .partners-inner { max-width: 900px; margin: 0 auto; }
        .partners-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.25rem; }
        .partner-card {
            border: 1px solid var(--gray-300); border-radius: var(--radius);
            padding: 1.25rem; min-height: 110px;
            display: flex; align-items: center; justify-content: center;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .partner-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-2px); }
        .partner-card img { max-height: 80px; object-fit: contain; filter: grayscale(100%); transition: filter 0.3s; }
        .partner-card:hover img { filter: none; }

        /* ── FAQ ── */
        .faq { padding: 4.5rem 1.5rem; background: var(--gray-100); border-top: 1px solid var(--gray-200); }
        .faq-inner { max-width: 780px; margin: 0 auto; }
        .faq-list { margin-bottom: 1.5rem; }
        .faq-item {
            background: #fff; border: 1px solid var(--gray-300);
            border-radius: var(--radius); margin-bottom: 0.75rem;
            overflow: hidden; box-shadow: var(--shadow);
        }
        .faq-header { display: flex; align-items: center; gap: 0.85rem; padding: 1rem 1.25rem; cursor: pointer; user-select: none; }
        .faq-num {
            width: 30px; height: 30px; border-radius: 50%;
            background: var(--red); color: #fff; font-weight: 700;
            font-size: 0.78rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .faq-q    { font-weight: 600; font-size: 0.93rem; flex: 1; color: var(--dark); }
        .faq-icon { color: var(--gray-600); font-size: 0.85rem; transition: transform 0.3s; flex-shrink: 0; }
        .faq-item.open .faq-icon { transform: rotate(180deg); color: var(--red); }
        .faq-body {
            display: none; padding: 0 1.25rem 1.1rem 4.1rem;
            color: #555; font-size: 0.9rem; line-height: 1.65;
        }
        .faq-item.open .faq-body { display: block; }
        .faq-contact {
            background: #fff; border: 1px solid #ffd6e0; border-radius: var(--radius);
            padding: 1.25rem 1.5rem; text-align: center; box-shadow: var(--shadow);
        }
        .faq-contact p { color: var(--gray-600); font-size: 0.9rem; margin-bottom: 0.45rem; }
        .faq-phone { color: var(--red); font-weight: 700; font-size: 1rem; display: inline-flex; align-items: center; gap: 8px; }

        /* ── REGISTRATION ── */
        .registration { padding: 5rem 1.5rem; background: #fff; }
        .reg-inner { max-width: 800px; margin: 0 auto; }
        .reg-badge {
            display: inline-block; background: #fff0f4; color: var(--red);
            border: 1px solid #ffd6e0; padding: 5px 14px; border-radius: 20px;
            font-size: 0.72rem; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; margin-bottom: 0.75rem;
        }
        .reg-title { font-size: clamp(1.8rem, 4vw, 2.6rem); font-weight: 900; margin-bottom: 0.5rem; }
        .reg-desc  { color: var(--gray-600); font-size: 0.93rem; line-height: 1.65; margin-bottom: 2rem; }
        .form-card {
            background: #fff; border: 1px solid var(--gray-300);
            border-radius: var(--radius); padding: 1.5rem;
            margin-bottom: 1rem; box-shadow: var(--shadow);
        }
        .form-card-head { display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.25rem; }
        .step-badge {
            width: 32px; height: 32px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: #fff; font-size: 0.85rem; flex-shrink: 0;
        }
        .step-badge.s1 { background: var(--red); }
        .step-badge.s2 { background: #3b82f6; }
        .step-badge.s3 { background: #8b5cf6; }
        .form-card-title { font-size: 1rem; font-weight: 700; color: var(--dark); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-field { margin-bottom: 1rem; }
        .form-field:last-child { margin-bottom: 0; }
        .form-field label { display: block; font-size: 0.82rem; font-weight: 600; color: var(--gray-700); margin-bottom: 0.4rem; }
        .form-field .req { color: var(--red); }
        .form-field input,
        .form-field select,
        .form-field textarea {
            display: block; width: 100%; padding: 0.72rem 0.9rem;
            border: 1.5px solid var(--gray-300); border-radius: 8px;
            font-size: 0.9rem; color: var(--dark); background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none; appearance: none; -webkit-appearance: none;
        }
        .form-field input:focus,
        .form-field select:focus,
        .form-field textarea:focus {
            border-color: var(--red); box-shadow: 0 0 0 3px rgba(224,29,80,0.1);
        }
        .form-field textarea { resize: vertical; min-height: 90px; }
        .form-field select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 0.9rem center;
            background-size: 0.9rem; padding-right: 2.25rem;
        }
        #group-details { display: none; }
        #spouse-field  { display: none; }
        .btn-submit {
            display: block; width: 100%; padding: 0.95rem;
            background: var(--red); color: #fff; border: none; border-radius: 8px;
            font-size: 0.88rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;
            cursor: pointer; transition: all 0.25s; margin-top: 0.5rem;
        }
        .btn-submit:hover { background: var(--red-dark); transform: translateY(-1px); box-shadow: 0 8px 24px rgba(224,29,80,0.35); }
        .btn-submit:disabled { opacity: 0.65; cursor: not-allowed; transform: none; box-shadow: none; }
        .reg-success {
            display: none; background: #f0fdf4; border: 1px solid #bbf7d0;
            border-radius: 8px; padding: 1.25rem; margin-top: 1rem;
            text-align: center; color: #166534; font-size: 0.92rem;
        }
        .reg-success i { font-size: 1.75rem; margin-bottom: 0.5rem; display: block; }

        /* ── CTA BAND ── */
        .cta-band { padding: 5rem 1.5rem; background: var(--dark); text-align: center; }
        .cta-band h2 { font-size: clamp(1.8rem, 3.8vw, 2.6rem); font-weight: 900; color: #fff; margin-bottom: 0.6rem; }
        .cta-band p  { color: rgba(255,255,255,0.55); font-size: 0.95rem; margin-bottom: 1.75rem; }
        .btn-cta {
            display: inline-block; background: var(--red); color: #fff;
            padding: 0.9rem 2rem; border-radius: 8px; font-weight: 700;
            font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase;
            transition: all 0.25s;
        }
        .btn-cta:hover { background: var(--red-dark); color: #fff; transform: translateY(-2px); box-shadow: 0 10px 30px rgba(224,29,80,0.4); }

        /* ── FOOTER ── */
        .footer { background: var(--dark); border-top: 1px solid rgba(255,255,255,0.07); }
        .footer-grid {
            display: grid; grid-template-columns: 1.6fr 1fr 1fr; gap: 3rem;
            max-width: 1140px; margin: 0 auto; padding: 3.5rem 2rem 2.5rem;
        }
        .footer-brand-name { color: var(--red); font-size: 1.5rem; font-weight: 900; margin-bottom: 0.75rem; }
        .footer-brand-desc { color: rgba(255,255,255,0.5); font-size: 0.9rem; line-height: 1.7; margin-bottom: 1.25rem; }
        .social-row { display: flex; gap: 0.6rem; }
        .social-btn {
            width: 38px; height: 38px; border-radius: 50%;
            background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem; transition: all 0.2s;
        }
        .social-btn:hover { background: var(--red); color: #fff; }
        .footer-col h4 { color: #fff; font-weight: 700; font-size: 0.9rem; letter-spacing: 0.5px; margin-bottom: 1rem; }
        .footer-col ul li { margin-bottom: 0.6rem; }
        .footer-col a { color: rgba(255,255,255,0.5); font-size: 0.88rem; transition: color 0.2s; }
        .footer-col a:hover { color: var(--red); }
        .footer-note { color: rgba(255,255,255,0.38); font-size: 0.84rem; line-height: 1.5; }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.07);
            padding: 1.1rem 2rem; text-align: center;
            max-width: 1140px; margin: 0 auto;
        }
        .footer-bottom p { color: rgba(255,255,255,0.3); font-size: 0.8rem; margin-bottom: 0.2rem; }
        .footer-bottom a { color: var(--red); }

        /* ── MODAL ── */
        .modal-overlay {
            position: fixed; inset: 0; z-index: 2000;
            display: none; align-items: center; justify-content: center;
            padding: 1.5rem; background: rgba(17,17,17,0.75);
            backdrop-filter: blur(4px);
        }
        .modal-overlay.is-open { display: flex; }
        .modal-box {
            width: min(100%, 420px); background: #fff; border-radius: 14px;
            padding: 2rem; text-align: center; position: relative;
            box-shadow: 0 30px 80px rgba(0,0,0,0.3);
            animation: modalIn 0.25s ease;
        }
        @keyframes modalIn {
            from { transform: scale(0.92) translateY(10px); opacity: 0; }
            to   { transform: scale(1) translateY(0); opacity: 1; }
        }
        .modal-close {
            position: absolute; top: 1rem; right: 1rem;
            width: 34px; height: 34px; border: none; border-radius: 50%;
            background: var(--gray-200); color: var(--dark);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 0.85rem; transition: background 0.2s;
        }
        .modal-close:hover { background: var(--gray-300); }
        .modal-wa-icon {
            width: 60px; height: 60px; border-radius: 50%;
            background: #25d366; color: #fff; margin: 0 auto 1rem;
            display: flex; align-items: center; justify-content: center; font-size: 2rem;
        }
        .modal-box h3 { font-size: 1.4rem; font-weight: 800; color: var(--dark); margin-bottom: 0.5rem; }
        .modal-box p  { color: var(--gray-600); font-size: 0.9rem; line-height: 1.6; margin-bottom: 1.25rem; }
        .btn-whatsapp {
            display: flex; align-items: center; justify-content: center; gap: 0.7rem;
            width: 100%; background: #25d366; color: #fff; border: none;
            border-radius: 8px; padding: 0.85rem 1rem; font-weight: 800;
            font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase;
            transition: background 0.2s, transform 0.2s; text-decoration: none;
        }
        .btn-whatsapp:hover { background: #1db954; color: #fff; transform: translateY(-1px); }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .stats-grid, .logistics-grid, .partners-grid, .footer-grid { grid-template-columns: 1fr; }
            .mission-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .nav-links {
                display: none; position: absolute; top: var(--nav-h); left: 0; right: 0;
                flex-direction: column; background: #fff;
                padding: 1rem 1.5rem; border-bottom: 1px solid var(--gray-300);
                gap: 0.9rem; box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            }
            .nav-links.is-open { display: flex; }
            .nav-toggle { display: flex; }
            .hero-title { letter-spacing: -1px; }
            .hero-perks { flex-direction: column; gap: 0.6rem; }
            .hero-perks .sep { display: none; }
            .form-row { grid-template-columns: 1fr; }
            .mission-card { flex-direction: column; }
        }
    </style>
</head>
<body>

<!-- NAV -->
<nav class="nav">
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="nav-logo">SPC<span>2026</span></a>
        <ul class="nav-links" id="navLinks">
            <li><a href="#about">About</a></li>
            <li><a href="#registration">Book A Seat</a></li>
            <li><a href="#partner">Partners</a></li>
            <li><a href="#faq">FAQ</a></li>
            {{-- <li><a href="{{ route('feedback') }}">Feedback</a></li> --}}
            @auth
                <li><a href="{{ route('dashboard') }}" class="nav-cta">Dashboard</a></li>
            @else
                {{-- <li><a href="{{ route('login') }}" class="nav-cta">Login</a></li> --}}
            @endauth
        </ul>
        <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <span class="hero-eyebrow">
            <i class="fas fa-star"></i> Sexual Purity Conference 2026
        </span>
        <h1 class="hero-title">THE POWER<br>OF HIS GRACE</h1>
        <p class="hero-verse">
            Romans 6:14 &ndash; <strong>&ldquo;For sin shall not have dominion over you: for ye are not under the law but under grace.&rdquo;</strong>
        </p>
        <div class="hero-actions">
            <a href="#registration" class="btn-primary">
                Register Now <i class="fas fa-arrow-right"></i>
            </a>
            <a href="#about" class="btn-outline">
                <i class="fas fa-book-open"></i> Learn More
            </a>
        </div>
        <div class="hero-perks">
            <span class="perk"><i class="fas fa-ticket"></i> Free admission</span>
            <span class="sep">&bull;</span>
            <span class="perk"><i class="fas fa-house"></i> Accommodation provided</span>
            <span class="sep">&bull;</span>
            <span class="perk"><i class="fas fa-microphone"></i> 3+ Inspired speakers</span>
        </div>
    </div>
    <span class="hero-scroll">
        <i class="fas fa-chevron-down"></i> Scroll
    </span>
</section>

<!-- STATS -->
<section class="stats">
    <div class="stats-inner">
        <div class="stats-grid">
            <div class="stat-card rose">
                <div class="stat-num">2026</div>
                <div class="stat-lbl">Year of Grace</div>
                <p class="stat-desc">A year dedicated to transformation through God&rsquo;s grace</p>
            </div>
            <div class="stat-card blue">
                <div class="stat-num">500+</div>
                <div class="stat-lbl">Seats Available</div>
                <p class="stat-desc">Join a community of believers seeking purity</p>
            </div>
            <div class="stat-card purple">
                <div class="stat-num">3+</div>
                <div class="stat-lbl">Inspired Speakers</div>
                <p class="stat-desc">Seasoned ministers sharing life-changing teachings</p>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section id="about" class="about">
    <div class="about-inner">
        <div class="sec-head">
            <h2 class="sec-title">The Burden</h2>
            <div class="sec-line"></div>
        </div>
        <div class="about-body">
            <p>We rose from last year&rsquo;s Sexual Purity Conference with a compelling conviction to walk in purity of life and heart; having seen clearly the debilitating spiritual and natural consequences of a sexually impure life.</p>
            <p>During the closing charge, God brought us a message titled, <span class="highlight">&ldquo;a compelling conviction powered by grace;&rdquo;</span> as we were made to understand that without the powering of Grace, a compelling conviction will not translate into a practical life of purity. It is grace that powers obedience to the truth; not just a mere knowledge of the truth.</p>
            <div class="blockquote-card">
                <p>This year, we are trusting God for a massive outpouring of His grace upon every life. Romans 6:14 is our theme text.</p>
            </div>
            <p>When a life comes under the power of grace, every negative dominion over that life is broken; that which is humanly impossible becomes so easy to achieve; natural weaknesses give way to spiritual strength; long time addictions are broken; and a sustaining walk in holiness becomes a possibility thereafter. Here is the burden for this year&rsquo;s conference.</p>
            <p>We encourage you to prepare your heart for a definite encounter with God which you will never recover from for the rest of your life. As usual, this is a camp meeting which helps you to come aside from every distraction to be alone with God. Feeding and accommodation will be provided as the Lord provides for our needs. If anyone however desires a special hotel booking, you can reach out to this number: <span class="phone-link">0814 751 0674</span>.</p>
            <p>Mind you, this meeting is not only for the unmarried. Married people also need this empowerment of grace so as to overcome the barrage of sexual temptations to defile their marriage bed which come their way every day on the internet, at the workplace, on the street and everywhere. Many are married yet addicted to porn, masturbation, call girls/Sugar Daddies and other similar vices. This conference is therefore blind to marital statuses. All that matters is for all to be empowered by grace to live a life that pleases God henceforth.</p>
            <p>Delegates are coming from different parts of the Southwest and we encourage this; as physical participation will always be the best option. However, for those who live outside the Southwest and in other nations, you can connect live to the program on Facebook and YouTube <a href="#" class="phone-link">@Peniela Akintujoye</a>.</p>
            <p>While participation is free, registration is compulsory. Ensure to register immediately to assist our planning. Invite your family and friends. A lot of people around you definitely need this. Do the work of an evangelist.</p>
            <div class="verse-box">
                <blockquote>&ldquo;And the Spirit and the bride say, Come. And let him that heareth say, Come. And let him that is athirst come. And whosoever will, let him take the water of life freely.&rdquo;</blockquote>
                <span class="verse-ref">Rev. 22:17</span>
            </div>
            <p>We can&rsquo;t wait to see you all.</p>
            <div class="sign">
                <p><strong>Your brother,</strong></p>
                <p><strong>Peniela Eniayo, Akintujoye</strong></p>
                <p>Pastor, MIV Rhema House and Lead Facilitator, Love Straight Talks</p>
            </div>
        </div>
    </div>
</section>

<!-- MISSION -->
<section class="mission">
    <div class="sec-head">
        <h2 class="sec-title">OUR MISSION</h2>
        <div class="sec-line"></div>
        <p class="sec-sub">Through grace, we empower lives to walk in purity and honor God</p>
    </div>
    <div class="mission-grid">
        <div class="mission-card rose">
            <div class="m-icon rose"><i class="fas fa-book"></i></div>
            <div class="m-body">
                <h3>Gain Biblical Understanding</h3>
                <p>Deepen your knowledge of purity, identity, and purpose through scriptural teachings grounded in God&rsquo;s word.</p>
            </div>
        </div>
        <div class="mission-card blue">
            <div class="m-icon blue"><i class="fas fa-heart"></i></div>
            <div class="m-body">
                <h3>Hear Life-Changing Testimonies</h3>
                <p>Connect with seasoned ministers and leaders who share transformative stories of grace and redemption.</p>
            </div>
        </div>
        <div class="mission-card purple">
            <div class="m-icon purple"><i class="fas fa-users"></i></div>
            <div class="m-body">
                <h3>Build Godly Relationships</h3>
                <p>Create accountability circles and meaningful connections with believers on the same journey.</p>
            </div>
        </div>
        <div class="mission-card amber">
            <div class="m-icon amber"><i class="fas fa-star"></i></div>
            <div class="m-body">
                <h3>Empower Young Hearts</h3>
                <p>Equip young people to honor God and resist the culture of compromise in today&rsquo;s world.</p>
            </div>
        </div>
    </div>
</section>

<!-- WHEN & WHERE -->
<section class="logistics">
    <div class="logistics-inner">
        <div class="sec-head">
            <h2 class="sec-title">WHEN &amp; WHERE</h2>
            <div class="sec-line"></div>
        </div>
        <div class="logistics-grid">
            <div class="l-card loc">
                <div class="l-icon"><i class="fas fa-map-marker-alt"></i></div>
                <h3>Location</h3>
                <p class="venue">The Trinity&rsquo;s Threshold Retreat Center</p>
                <p class="detail">Beside Christ Victorious Life International Ministries<br>Olorunda-Akobo, Ibadan</p>
            </div>
            <div class="l-card sched">
                <div class="l-icon"><i class="fas fa-calendar-alt"></i></div>
                <h3>Schedule</h3>
                <div class="sched-row">
                    <span class="date">August 20</span>
                    <span class="time">4:00 PM &ndash; 8:00 PM</span>
                </div>
                <div class="sched-row">
                    <span class="date">August 21&ndash;22</span>
                    <span class="time">8:00 AM &ndash; 8:00 PM</span>
                </div>
                <div class="sched-row">
                    <span class="date">August 23</span>
                    <span class="time">8:00 AM &ndash; 2:00 PM</span>
                </div>
            </div>
            <div class="l-card hotel">
                <div class="l-icon"><i class="fas fa-hotel"></i></div>
                <h3>Accommodation</h3>
                <p class="detail">Feeding and accommodation provided. For special hotel bookings:</p>
                <div class="hotel-phone"><i class="fas fa-phone"></i> 0814 751 0674</div>
            </div>
        </div>
        <div class="directions-box">
            <h3><i class="fas fa-route" style="color:var(--red);margin-right:0.5rem;"></i>Getting There</h3>
            <p><span class="dir-lbl">From Ojurin-Akobo:</span> Take a bike or Keke going to Olorunda. Alight in front of Christ Victorious Life Church (Ore-Ofe II Bus stop). You&rsquo;ll see a turning to the right beside the church&mdash;don&rsquo;t turn there. The next turning to the right is where you&rsquo;re going. Turn in and walk straight up. The Retreat Center is at the end of that street.</p>
            <p><span class="dir-lbl">Driving:</span> Use Google Maps and search &ldquo;The Trinity&rsquo;s Threshold&rdquo; for navigation.</p>
        </div>
    </div>
</section>

<!-- PARTNERS -->
<section id="partner" class="partners">
    <div class="partners-inner">
        <div class="sec-head">
            <h2 class="sec-title">OUR PARTNERS</h2>
            <div class="sec-line"></div>
            <p class="sec-sub">Partnering with organizations committed to purity</p>
        </div>
        <div class="partners-grid">
            <div class="partner-card">
                <img src="{{ asset('frontend/image/lst.png') }}" alt="Love Straight Talks">
            </div>
            <div class="partner-card">
                <img src="{{ asset('frontend/image/rhema.jpg') }}" alt="MIV Rhema House">
            </div>
            <div class="partner-card">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSgKIcYujg3-v8XqMxPpS4rtzuH0wXgP_dGyw&s" alt="Partner 3">
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section id="faq" class="faq">
    <div class="faq-inner">
        <div class="sec-head">
            <h2 class="sec-title">Frequently Asked</h2>
            <div class="sec-line"></div>
            <p class="sec-sub">Find answers to common questions about the conference</p>
        </div>
        <div class="faq-list">
            <div class="faq-item">
                <div class="faq-header" onclick="toggleFaq(this)">
                    <span class="faq-num">1</span>
                    <span class="faq-q">What is the price of the ticket?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-body">The ticket for the Sexual Purity Conference 2026 is absolutely free! However, we do require registration in advance to secure your spot at the event. We look forward to having you with us!</div>
            </div>
            <div class="faq-item">
                <div class="faq-header" onclick="toggleFaq(this)">
                    <span class="faq-num">2</span>
                    <span class="faq-q">What is included in my ticket?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-body">Your ticket grants you access to all conference sessions, including keynote speeches, panel discussions, and interactive workshops. Feeding and accommodation are provided as the Lord provides. You&rsquo;ll also have the opportunity to connect with like-minded believers.</div>
            </div>
            <div class="faq-item">
                <div class="faq-header" onclick="toggleFaq(this)">
                    <span class="faq-num">3</span>
                    <span class="faq-q">How should I dress?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-body">We encourage smart casual and modest attire for the conference. Please dress comfortably, as you may participate in interactive sessions and workshops. Ensure your clothing reflects the values of the conference &mdash; purity, dignity, and honor to God.</div>
            </div>
            <div class="faq-item">
                <div class="faq-header" onclick="toggleFaq(this)">
                    <span class="faq-num">4</span>
                    <span class="faq-q">I have specific questions that are not addressed here. Who can help me?</span>
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-body">If you have any further questions, feel free to contact our event support team at <strong>mivrhemahouse@gmail.com</strong> or call us at <strong>0814 751 0674</strong>. We&rsquo;ll be happy to assist you with any inquiries regarding the event or registration process.</div>
            </div>
        </div>
        <div class="faq-contact">
            <p>Still have questions? We&rsquo;re here to help!</p>
            <span class="faq-phone"><i class="fas fa-phone"></i> 0814 751 0674</span>
        </div>
    </div>
</section>

<!-- REGISTRATION -->
<section id="registration" class="registration">
    <div class="reg-inner">
        <span class="reg-badge">Sexual Purity Conference 2026</span>
        <h2 class="reg-title">Register Now</h2>
        <p class="reg-desc">Join us for a life-transforming encounter with God. Admission is free, but registration is compulsory to help us plan. Arrival: 4:00 PM on Friday, August 20, 2026.</p>

        <form id="registration-form">
            @csrf
            <div class="form-card">
                <div class="form-card-head">
                    <span class="step-badge s1">1</span>
                    <span class="form-card-title">Personal Information</span>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="fullname">Full Name <span class="req">*</span></label>
                        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-field">
                        <label for="gender">Gender <span class="req">*</span></label>
                        <select id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="phone">Phone Number <span class="req">*</span></label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                    </div>
                    <div class="form-field">
                        <label for="email">Email Address <span class="req">*</span></label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="city">City/Location <span class="req">*</span></label>
                        <input type="text" id="city" name="location" placeholder="Enter your city" required>
                    </div>
                    <div class="form-field">
                        <label for="state">State <span class="req">*</span></label>
                        <select id="state" name="state" required>
                            <option value="">Select State</option>
                            <option>Abia</option><option>Adamawa</option><option>Akwa Ibom</option>
                            <option>Anambra</option><option>Bauchi</option><option>Bayelsa</option>
                            <option>Benue</option><option>Borno</option><option>Cross River</option>
                            <option>Delta</option><option>Ebonyi</option><option>Edo</option>
                            <option>Ekiti</option><option>Enugu</option><option>FCT – Abuja</option>
                            <option>Gombe</option><option>Imo</option><option>Jigawa</option>
                            <option>Kaduna</option><option>Kano</option><option>Katsina</option>
                            <option>Kebbi</option><option>Kogi</option><option>Kwara</option>
                            <option>Lagos</option><option>Nasarawa</option><option>Niger</option>
                            <option>Ogun</option><option>Ondo</option><option>Osun</option>
                            <option>Oyo</option><option>Plateau</option><option>Rivers</option>
                            <option>Sokoto</option><option>Taraba</option><option>Yobe</option>
                            <option>Zamfara</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="form-card-head">
                    <span class="step-badge s2">2</span>
                    <span class="form-card-title">Participation Details</span>
                </div>
                <div class="form-field">
                    <label for="how_heard">How did you hear about the Sexual Purity Conference? <span class="req">*</span></label>
                    <select id="how_heard" name="how_heard" required>
                        <option value="">Select an option</option>
                        <option value="church-announcement">Church Announcement</option>
                        <option value="social-media">Social Media</option>
                        <option value="friend-family">Friend / Family</option>
                        <option value="whatsapp-group">WhatsApp Group</option>
                        <option value="billboard">Billboard</option>
                        <option value="banner">Banner</option>
                        <option value="handbill">Handbill</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="previous_participation">Have you attended previous conferences? <span class="req">*</span></label>
                    <select id="previous_participation" name="previous_participation" required>
                        <option value="">Select an option</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="mode_of_participation">Mode of Participation <span class="req">*</span></label>
                    <select id="mode_of_participation" name="mode_of_participation" required onchange="toggleAccommodation(this)">
                        <option value="">Select an option</option>
                        <option value="physical">Physical</option>
                        <option value="virtual">Virtual</option>
                    </select>
                </div>
                <div id="accommodation-field" class="form-field" style="display:none;">
                    <label for="accommodation_preference">Accommodation Arrangement <span class="req">*</span></label>
                    <select id="accommodation_preference" name="accommodation_preference">
                        <option value="">Select an option</option>
                        <option value="own-accommodation">I have accommodation close to the venue</option>
                        <option value="conference-accommodation">I want the conference accommodation (provided)</option>
                        <option value="hotel-booking">Please help me book a hotel</option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="registration_type">Are you registering as an individual or on behalf of a group? <span class="req">*</span></label>
                    <select id="registration_type" name="registration_type" required onchange="toggleGroup(this)">
                        <option value="">Select an option</option>
                        <option value="individual">Individual</option>
                        <option value="group">Group</option>
                    </select>
                </div>
                <div id="group-details">
                    <div class="form-row">
                        <div class="form-field">
                            <label for="group_name">Group Name</label>
                            <input type="text" id="group_name" name="group_name" placeholder="Enter group name">
                        </div>
                        <div class="form-field">
                            <label for="group_size">Number of Participants</label>
                            <input type="number" id="group_size" name="group_size" placeholder="e.g. 5" min="2">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="form-card-head">
                    <span class="step-badge s3">3</span>
                    <span class="form-card-title">Expectations &amp; Commitments</span>
                </div>
                <div class="form-field">
                    <label for="expectations">What are your expectations for this conference?</label>
                    <textarea id="expectations" name="expectations" placeholder="Share what you hope to gain from attending..."></textarea>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="commitment">Do you commit to attend all sessions? <span class="req">*</span></label>
                        <select id="commitment" name="commitment" required>
                            <option value="">Select an option</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label for="marital_status">Marital Status <span class="req">*</span></label>
                        <select id="marital_status" name="marital_status" required onchange="toggleSpouse(this)">
                            <option value="">Select an option</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                        </select>
                    </div>
                </div>
                <div id="spouse-field" class="form-field">
                    <label for="coming_with_spouse">Are you coming with your spouse?</label>
                    <select id="coming_with_spouse" name="coming_with_spouse">
                        <option value="">Select an option</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="receive_updates">Receive updates and resources after the conference? <span class="req">*</span></label>
                    <select id="receive_updates" name="receive_updates" required>
                        <option value="">Select an option</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-submit" id="reg-submit-btn">Submit Registration</button>
        </form>
        <div class="reg-success" id="reg-success">
            <i class="fas fa-check-circle"></i>
            Thank you for registering! You will receive a confirmation and event details shortly. Please follow our social media pages for updates.
        </div>
    </div>
</section>

<!-- CTA BAND -->
<section class="cta-band">
    <h2>Ready for an encounter with God?</h2>
    <p>Registration is free and compulsory. Register now to secure your spot.</p>
    <a href="#registration" class="btn-cta">Register Now &rarr;</a>
</section>

<!-- FOOTER -->
<footer style="background:#111;color:#fff;padding:40px 20px 20px;text-align:center;">
    
    <h3 style="margin-bottom:15px;font-size:24px;">Contact Us</h3>

    <p style="margin:10px 0;line-height:1.7;">
        <strong>Phone:</strong>
        <a href="tel:+2347066722832" style="color:red;text-decoration:none;">
            +234 706 672 2832
        </a>
    </p>

    <p style="margin:10px auto;line-height:1.7;max-width:700px;">
        <strong>Address:</strong><br>
      Cecillia Building, Beside Monarch Plaza, Adjacent Omololu Hospital, Ojurin-Akobo, Ibadan, Nigeria. 
    </p>

    <div style="margin-top:25px;padding-top:15px;border-top:1px solid rgba(255,255,255,0.15);">
        <p style="margin:5px 0;">
            Developed by
            <a href="https://mivrhemahouse.org.ng" target="_blank"
               style="color:red;text-decoration:none;">
                MIV Rhema House Media
            </a>
        </p>

        <p style="margin:5px 0;">
            &copy; 2026 Sexual Purity Conference. All Rights Reserved.
        </p>
    </div>

</footer>
<!-- WHATSAPP MODAL -->
<div class="modal-overlay" id="whatsapp-modal" aria-hidden="true" role="dialog" aria-labelledby="whatsapp-modal-title">
    <div class="modal-box">
        <button type="button" class="modal-close" id="whatsapp-modal-close" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <div class="modal-wa-icon"><i class="fab fa-whatsapp"></i></div>
        <h3 id="whatsapp-modal-title">Registration Received</h3>
        <p id="whatsapp-modal-message">Your details have been saved. Join the WhatsApp group now for important conference updates.</p>
        <a class="btn-whatsapp" href="https://chat.whatsapp.com/DE2ORr5WTujFdvADwJi1GO?s=cl&amp;p=i&amp;mlu=3" target="_blank" rel="noopener">
            <i class="fab fa-whatsapp"></i> Join WhatsApp Group
        </a>
    </div>
</div>

<script src="{{ asset('frontend/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    document.getElementById('navToggle').addEventListener('click', function() {
        document.getElementById('navLinks').classList.toggle('is-open');
    });

    function toggleFaq(header) {
        var item = header.parentElement;
        var isOpen = item.classList.contains('open');
        document.querySelectorAll('.faq-item').forEach(function(el) { el.classList.remove('open'); });
        if (!isOpen) item.classList.add('open');
    }

    function toggleAccommodation(select) {
        var field = document.getElementById('accommodation-field');
        var accSelect = document.getElementById('accommodation_preference');
        if (select.value === 'physical') {
            field.style.display = 'block';
            accSelect.setAttribute('required', 'required');
        } else {
            field.style.display = 'none';
            accSelect.removeAttribute('required');
            accSelect.value = '';
        }
    }

    function toggleGroup(select) {
        document.getElementById('group-details').style.display = select.value === 'group' ? 'block' : 'none';
    }

    function toggleSpouse(select) {
        document.getElementById('spouse-field').style.display = select.value === 'married' ? 'block' : 'none';
    }

    function openWhatsAppModal(message) {
        var modal = document.getElementById('whatsapp-modal');
        document.getElementById('whatsapp-modal-message').textContent = message || 'Your details have been saved. Join the WhatsApp group now for important conference updates.';
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
    }

    function closeWhatsAppModal() {
        var modal = document.getElementById('whatsapp-modal');
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
    }

    document.getElementById('whatsapp-modal-close').addEventListener('click', closeWhatsAppModal);
    document.getElementById('whatsapp-modal').addEventListener('click', function(e) {
        if (e.target === this) closeWhatsAppModal();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeWhatsAppModal();
    });

    $('#registration-form').on('submit', function(e) {
        e.preventDefault();
        var btn = document.getElementById('reg-submit-btn');
        btn.disabled = true;
        btn.textContent = 'Submitting...';

        $.ajax({
            url: "{{ route('register.conference') }}",
            method: "POST",
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function(res) {
                toastr.success(res.message);
                $('#registration-form')[0].reset();
                document.getElementById('group-details').style.display = 'none';
                document.getElementById('spouse-field').style.display = 'none';
                document.getElementById('accommodation-field').style.display = 'none';
                document.getElementById('reg-success').style.display = 'block';
                openWhatsAppModal(res.message);
                btn.disabled = false;
                btn.textContent = 'Submit Registration';
            },
            error: function(xhr) {
                btn.disabled = false;
                btn.textContent = 'Submit Registration';
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    for (var field in errors) { toastr.error(errors[field][0]); }
                } else {
                    toastr.error('Something went wrong. Please try again.');
                }
            }
        });
    });
</script>

</body>
</html>
