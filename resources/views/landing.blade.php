<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoSchool — Invoice Management System | everthings.in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ===================== CSS VARIABLES ===================== */
        :root {
            --amber: #F5A623;
            --amber-l: #FFD166;
            --amber-d: #C8820A;
            --teal: #2DD4BF;
            --rose: #F43F5E;
            --radius: 16px;
            --trans: 0.35s cubic-bezier(.4, 0, .2, 1);
        }

        [data-theme="dark"] {
            --bg: #0C0A06;
            --bg2: #14110A;
            --bg3: #1E1810;
            --bg4: #28200F;
            --surface: rgba(255, 255, 255, 0.04);
            --surface2: rgba(255, 255, 255, 0.07);
            --border: rgba(245, 166, 35, 0.14);
            --border2: rgba(245, 166, 35, 0.28);
            --text: #F5F0E8;
            --text2: rgba(245, 240, 232, 0.6);
            --text3: rgba(245, 240, 232, 0.35);
            --card-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            --nav-blur: rgba(12, 10, 6, 0.92);
        }

        [data-theme="light"] {
            --bg: #FFFDF7;
            --bg2: #FFF8EE;
            --bg3: #FFF0D8;
            --bg4: #FDEAC0;
            --surface: rgba(0, 0, 0, 0.03);
            --surface2: rgba(0, 0, 0, 0.06);
            --border: rgba(180, 110, 0, 0.15);
            --border2: rgba(180, 110, 0, 0.3);
            --text: #1A1206;
            --text2: rgba(26, 18, 6, 0.6);
            --text3: rgba(26, 18, 6, 0.35);
            --card-shadow: 0 20px 60px rgba(200, 130, 10, 0.12);
            --nav-blur: rgba(255, 253, 247, 0.94);
        }

        /* ===================== BASE ===================== */
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            transition: background var(--trans), color var(--trans);
            overflow-x: hidden;
            cursor: none;
        }

        ::selection {
            background: var(--amber);
            color: #000;
        }

        /* ===================== SCROLLBAR ===================== */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--amber-d);
            border-radius: 3px;
        }

        /* ===================== CUSTOM CURSOR ===================== */
        #cur-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--amber);
            position: fixed;
            pointer-events: none;
            z-index: 99999;
            transform: translate(-50%, -50%);
            transition: transform .15s, width .2s, height .2s;
        }

        #cur-ring {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1.5px solid var(--amber);
            position: fixed;
            pointer-events: none;
            z-index: 99998;
            transform: translate(-50%, -50%);
            opacity: .5;
            transition: left .1s ease, top .1s ease, width .2s, height .2s, opacity .2s;
        }

        .cursor-hover #cur-dot {
            width: 6px;
            height: 6px;
            background: var(--amber-l);
        }

        .cursor-hover #cur-ring {
            width: 54px;
            height: 54px;
            opacity: .25;
        }

        /* ===================== THREE.JS CANVAS ===================== */
        #three-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            opacity: .7;
            transition: opacity var(--trans);
        }

        [data-theme="light"] #three-canvas {
            opacity: .35;
        }

        /* ===================== NAVBAR ===================== */
        #navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 20px 0;
            transition: all .4s ease;
        }

        #navbar.scrolled {
            background: var(--nav-blur);
            backdrop-filter: blur(24px) saturate(1.5);
            -webkit-backdrop-filter: blur(24px) saturate(1.5);
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.2);
        }

        .brand {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.65rem;
            color: var(--amber) !important;
            text-decoration: none;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand .b-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--amber), var(--amber-d));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-size: .9rem;
        }

        .brand .b-name {
            color: var(--text);
        }

        .nav-link {
            font-size: .83rem;
            font-weight: 600;
            letter-spacing: .5px;
            text-transform: uppercase;
            color: var(--text2) !important;
            padding: 8px 14px !important;
            position: relative;
            transition: color .3s !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            width: 0;
            height: 1.5px;
            background: var(--amber);
            transition: .3s;
            transform: translateX(-50%);
        }

        .nav-link:hover {
            color: var(--amber) !important;
        }

        .nav-link:hover::after {
            width: 55%;
        }

        .nav-link.active-p {
            color: var(--amber) !important;
        }

        .nav-link.active-p::after {
            width: 55%;
        }

        .btn-try {
            background: linear-gradient(135deg, var(--amber), var(--amber-d));
            color: #000 !important;
            padding: 10px 22px !important;
            border-radius: 50px;
            font-weight: 700 !important;
            box-shadow: 0 4px 20px rgba(245, 166, 35, .3);
            transition: all .3s !important;
        }

        .btn-try::after {
            display: none !important;
        }

        .btn-try:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(245, 166, 35, .45) !important;
        }

        /* THEME TOGGLE */
        .theme-toggle {
            width: 42px;
            height: 24px;
            border-radius: 12px;
            background: var(--surface2);
            border: 1px solid var(--border2);
            position: relative;
            cursor: pointer;
            transition: background .3s;
        }

        .theme-toggle .knob {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--amber);
            transition: left .3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .55rem;
            color: #000;
        }

        [data-theme="light"] .theme-toggle .knob {
            left: 21px;
        }

        .toggle-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .75rem;
            color: var(--text3);
        }

        /* HAMBURGER */
        .navbar-toggler {
            border: 1px solid var(--border2) !important;
            padding: 6px 10px !important;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(245,166,35,0.9)' stroke-linecap='round' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        .navbar-collapse {
            background: var(--nav-blur);
            border-radius: var(--radius);
            padding: 16px;
            margin-top: 8px;
            border: 1px solid var(--border);
            backdrop-filter: blur(20px);
        }

        /* ===================== HERO ===================== */
        .hero {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            padding-top: 90px;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            z-index: 1;
            background: radial-gradient(ellipse 70% 70% at 70% 50%,
                    rgba(92, 61, 20, 0.35) 0%, transparent 70%),
                radial-gradient(ellipse 40% 60% at 15% 80%,
                    rgba(245, 166, 35, 0.1) 0%, transparent 60%);
            transition: background .5s;
        }

        [data-theme="light"] .hero-overlay {
            background: radial-gradient(ellipse 70% 70% at 70% 50%,
                    rgba(245, 166, 35, 0.12) 0%, transparent 70%),
                radial-gradient(ellipse 40% 60% at 15% 80%,
                    rgba(245, 166, 35, 0.08) 0%, transparent 60%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .announce-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--surface2);
            border: 1px solid var(--border2);
            color: var(--amber);
            padding: 6px 18px 6px 8px;
            border-radius: 50px;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 28px;
        }

        .announce-pill .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--amber);
            animation: pulse-dot 1.8s infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(245, 166, 35, .5)
            }

            50% {
                box-shadow: 0 0 0 6px rgba(245, 166, 35, 0)
            }
        }

        .hero-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: clamp(2.6rem, 6.5vw, 5.2rem);
            line-height: 1.06;
            margin-bottom: 24px;
            color: var(--text);
        }

        .hero-title .line {
            display: block;
            overflow: hidden;
        }

        .hero-title .line span {
            display: inline-block;
            transform: translateY(100%);
            animation: slideUp .8s ease forwards;
        }

        .hero-title .line:nth-child(2) span {
            animation-delay: .15s;
        }

        .hero-title .line:nth-child(3) span {
            animation-delay: .3s;
        }

        @keyframes slideUp {
            to {
                transform: translateY(0);
            }
        }

        .grad-text {
            background: linear-gradient(90deg, var(--amber), var(--amber-l), var(--amber));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            to {
                background-position: 200% center;
            }
        }

        .hero-sub {
            font-size: 1.1rem;
            color: var(--text2);
            line-height: 1.8;
            max-width: 500px;
            margin-bottom: 36px;
            animation: fadeUp .9s ease .5s both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .btn-primary-g {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--amber), var(--amber-d));
            color: #000;
            font-weight: 700;
            font-size: .95rem;
            padding: 15px 32px;
            border-radius: 50px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 12px 40px rgba(245, 166, 35, .35);
            transition: all .3s;
            animation: fadeUp .9s ease .65s both;
        }

        .btn-primary-g:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 50px rgba(245, 166, 35, .5);
            color: #000;
        }

        .btn-outline-g {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: var(--text);
            font-weight: 600;
            font-size: .92rem;
            padding: 14px 28px;
            border-radius: 50px;
            border: 1.5px solid var(--border2);
            text-decoration: none;
            cursor: pointer;
            transition: all .3s;
            animation: fadeUp .9s ease .75s both;
        }

        .btn-outline-g:hover {
            border-color: var(--amber);
            color: var(--amber);
            transform: translateY(-3px);
        }

        .hero-trust {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 28px;
            animation: fadeUp .9s ease .85s both;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .8rem;
            color: var(--text3);
        }

        .trust-item i {
            color: var(--teal);
        }

        /* INVOICE HERO CARD */
        .hero-visual {
            position: relative;
            z-index: 2;
            animation: fadeUp 1s ease .4s both;
        }

        .inv-card {
            background: var(--surface);
            border: 1px solid var(--border2);
            border-radius: 20px;
            padding: 28px;
            backdrop-filter: blur(20px);
            box-shadow: var(--card-shadow), 0 0 0 1px rgba(255, 255, 255, .03) inset;
            position: relative;
        }

        .inv-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 10%;
            right: 10%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--amber), transparent);
        }

        .inv-hdr {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 18px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .inv-logo {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--amber), var(--amber-d));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-size: 1rem;
        }

        .inv-num {
            font-family: 'Syne', sans-serif;
            font-size: .95rem;
            font-weight: 800;
            color: var(--amber);
        }

        .inv-lbl {
            font-size: .6rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text3);
        }

        .inv-row {
            display: flex;
            justify-content: space-between;
            padding: 7px 0;
            border-bottom: 1px solid var(--surface2);
            font-size: .73rem;
        }

        .inv-row .lbl {
            color: var(--text3);
        }

        .inv-row .val {
            font-weight: 600;
            color: var(--text);
        }

        .inv-total {
            background: linear-gradient(135deg, rgba(245, 166, 35, .12), rgba(245, 166, 35, .04));
            border: 1px solid var(--border2);
            border-radius: 12px;
            padding: 14px;
            margin-top: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .inv-total .tl {
            font-size: .7rem;
            color: var(--text3);
        }

        .inv-total .tv {
            font-family: 'Syne', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--amber);
        }

        .sbadge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: .6rem;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .s-paid {
            background: rgba(45, 212, 191, .1);
            color: var(--teal);
            border: 1px solid rgba(45, 212, 191, .25);
        }

        .s-pend {
            background: rgba(245, 166, 35, .12);
            color: var(--amber-l);
            border: 1px solid rgba(245, 166, 35, .25);
        }

        .s-due {
            background: rgba(244, 63, 94, .1);
            color: var(--rose);
            border: 1px solid rgba(244, 63, 94, .25);
        }

        /* FLOATING CARDS */
        .float-card {
            position: absolute;
            border-radius: 14px;
            padding: 12px 16px;
            background: var(--bg3);
            border: 1px solid var(--border2);
            backdrop-filter: blur(16px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, .3);
            font-size: .75rem;
        }

        [data-theme="light"] .float-card {
            box-shadow: 0 12px 32px rgba(200, 130, 10, .15);
        }

        .fc1 {
            top: -18px;
            right: -24px;
            animation: floatA 4s ease-in-out infinite;
        }

        .fc2 {
            bottom: 20px;
            left: -28px;
            animation: floatB 3.5s ease-in-out infinite;
        }

        .fc-num {
            font-family: 'Syne', sans-serif;
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--amber);
        }

        .fc-desc {
            color: var(--text3);
            font-size: .68rem;
        }

        @keyframes floatA {

            0%,
            100% {
                transform: translateY(0) rotate(-2deg)
            }

            50% {
                transform: translateY(-10px) rotate(2deg)
            }
        }

        @keyframes floatB {

            0%,
            100% {
                transform: translateY(0) rotate(1deg)
            }

            50% {
                transform: translateY(-8px) rotate(-1deg)
            }
        }

        /* ===================== STATS ===================== */
        .stats-strip {
            position: relative;
            z-index: 2;
            background: var(--bg2);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 44px 0;
        }

        .stat-box {
            text-align: center;
        }

        .stat-box .sn {
            font-family: 'Syne', sans-serif;
            font-size: 2.4rem;
            font-weight: 800;
            color: var(--amber);
        }

        .stat-box .sd {
            font-size: .82rem;
            color: var(--text3);
            margin-top: 4px;
        }

        .stat-divider {
            width: 1px;
            background: var(--border);
            align-self: stretch;
        }

        /* ===================== SECTIONS ===================== */
        section {
            position: relative;
            z-index: 2;
        }

        .sec-pad {
            padding: 100px 0;
        }

        .sec-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--amber);
            margin-bottom: 12px;
        }

        .sec-tag::before {
            content: '';
            width: 20px;
            height: 1.5px;
            background: var(--amber);
        }

        .sec-h {
            font-family: 'Syne', sans-serif;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 14px;
            color: var(--text);
        }

        .sec-sub {
            font-size: .97rem;
            color: var(--text2);
            line-height: 1.8;
            max-width: 560px;
        }

        /* ===================== FEATURE CARDS ===================== */
        .feat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            position: relative;
            overflow: hidden;
            transition: all .4s ease;
        }

        .feat-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--amber), transparent);
            opacity: 0;
            transition: .4s;
        }

        .feat-card:hover {
            transform: translateY(-8px);
            border-color: var(--border2);
            box-shadow: 0 24px 60px rgba(245, 166, 35, .08);
        }

        .feat-card:hover::after {
            opacity: 1;
        }

        .feat-ico {
            width: 52px;
            height: 52px;
            border-radius: 13px;
            background: linear-gradient(135deg, rgba(245, 166, 35, .15), rgba(245, 166, 35, .04));
            border: 1px solid var(--border2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: var(--amber);
            margin-bottom: 18px;
        }

        .feat-card h4 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text);
        }

        .feat-card p {
            font-size: .85rem;
            color: var(--text2);
            line-height: 1.72;
        }

        .feat-num {
            position: absolute;
            top: 20px;
            right: 20px;
            font-family: 'Syne', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--border);
            line-height: 1;
        }

        /* ===================== PROBLEM / SOLUTION ===================== */
        .ps-wrap {
            background: var(--bg2);
        }

        .pain-it {
            display: flex;
            gap: 14px;
            padding: 18px;
            margin-bottom: 12px;
            background: rgba(244, 63, 94, .05);
            border: 1px solid rgba(244, 63, 94, .12);
            border-radius: 14px;
        }

        .pain-it .icon i {
            color: var(--rose);
            font-size: 1.2rem;
            margin-top: 2px;
        }

        .pain-it h5 {
            font-size: .9rem;
            font-weight: 700;
            color: var(--rose);
            margin-bottom: 4px;
        }

        .pain-it p {
            font-size: .8rem;
            color: var(--text3);
            margin: 0;
        }

        .sol-it {
            display: flex;
            gap: 14px;
            padding: 18px;
            margin-bottom: 12px;
            background: rgba(45, 212, 191, .05);
            border: 1px solid rgba(45, 212, 191, .15);
            border-radius: 14px;
        }

        .sol-it .icon i {
            color: var(--teal);
            font-size: 1.2rem;
            margin-top: 2px;
        }

        .sol-it h5 {
            font-size: .9rem;
            font-weight: 700;
            color: var(--teal);
            margin-bottom: 4px;
        }

        .sol-it p {
            font-size: .8rem;
            color: var(--text3);
            margin: 0;
        }

        /* ===================== WORKFLOW ===================== */
        .step-c {
            text-align: center;
            padding: 28px 20px;
            position: relative;
        }

        .step-n {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--amber), var(--amber-d));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            color: #000;
            margin: 0 auto 18px;
            position: relative;
            z-index: 1;
            box-shadow: 0 8px 24px rgba(245, 166, 35, .35);
        }

        .step-c h5 {
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text);
        }

        .step-c p {
            font-size: .83rem;
            color: var(--text2);
            line-height: 1.65;
        }

        .step-line {
            position: absolute;
            top: 38px;
            right: -50%;
            left: 50%;
            height: 1px;
            background: linear-gradient(90deg, var(--amber-d), transparent);
        }

        /* ===================== PRICING ===================== */
        .price-c {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 38px 30px;
            text-align: center;
            height: 100%;
            transition: all .4s;
        }

        .price-c:hover {
            transform: translateY(-10px);
        }

        .price-c.feat-price {
            background: linear-gradient(135deg, rgba(245, 166, 35, .12), rgba(245, 166, 35, .04));
            border-color: var(--amber);
            box-shadow: 0 0 60px rgba(245, 166, 35, .12);
            position: relative;
        }

        .popular-tag {
            position: absolute;
            top: -14px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--amber), var(--amber-d));
            color: #000;
            padding: 4px 18px;
            border-radius: 20px;
            font-size: .62rem;
            font-weight: 800;
            letter-spacing: 2px;
            white-space: nowrap;
        }

        .price-c .plan-n {
            font-size: .72rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--amber);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .price-c .price-n {
            font-family: 'Syne', sans-serif;
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--text);
        }

        .price-c .price-n span {
            font-size: .9rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text3);
        }

        .feat-ul {
            list-style: none;
            text-align: left;
            margin: 20px 0;
        }

        .feat-ul li {
            font-size: .85rem;
            padding: 7px 0;
            color: var(--text2);
            border-bottom: 1px solid var(--border);
        }

        .feat-ul li i {
            color: var(--amber);
            margin-right: 8px;
            width: 14px;
        }

        .feat-ul li.dis {
            opacity: .35;
        }

        .feat-ul li.dis i {
            color: var(--text3);
        }

        .btn-p-main {
            display: block;
            width: 100%;
            padding: 13px;
            border-radius: 50px;
            font-weight: 700;
            font-size: .9rem;
            background: linear-gradient(135deg, var(--amber), var(--amber-d));
            color: #000;
            border: none;
            cursor: pointer;
            transition: .3s;
            text-decoration: none;
        }

        .btn-p-main:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(245, 166, 35, .4);
            color: #000;
        }

        .btn-p-out {
            display: block;
            width: 100%;
            padding: 12px;
            border-radius: 50px;
            font-weight: 700;
            font-size: .9rem;
            background: transparent;
            color: var(--text);
            border: 1.5px solid var(--border2);
            cursor: pointer;
            transition: .3s;
            text-decoration: none;
        }

        .btn-p-out:hover {
            border-color: var(--amber);
            color: var(--amber);
            text-decoration: none;
        }

        /* ===================== TESTIMONIALS CAROUSEL ===================== */
        .testi-section {
            background: var(--bg2);
        }

        .carousel-wrapper {
            position: relative;
            overflow: hidden;
        }

        .testi-track {
            display: flex;
            transition: transform .6s cubic-bezier(.4, 0, .2, 1);
        }

        .testi-slide {
            flex: 0 0 calc(33.333% - 20px);
            margin: 0 10px;
            min-width: 0;
        }

        .testi-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 28px;
            height: 100%;
            transition: border-color .3s;
        }

        .testi-card:hover {
            border-color: var(--border2);
        }

        .testi-stars {
            color: var(--amber);
            font-size: .85rem;
            margin-bottom: 14px;
        }

        .testi-card p {
            font-size: .88rem;
            color: var(--text2);
            line-height: 1.8;
            font-style: italic;
            margin-bottom: 18px;
        }

        .testi-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .t-ava {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: .9rem;
            color: #000;
            flex-shrink: 0;
        }

        .t-name {
            font-weight: 700;
            font-size: .88rem;
            color: var(--text);
        }

        .t-role {
            font-size: .72rem;
            color: var(--text3);
        }

        .carousel-ctrl {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 28px;
            align-items: center;
        }

        .c-btn {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--surface2);
            border: 1px solid var(--border2);
            color: var(--text2);
            font-size: .9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .3s;
        }

        .c-btn:hover {
            background: var(--amber);
            color: #000;
            border-color: var(--amber);
        }

        .c-dots {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .c-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--border2);
            transition: .3s;
            cursor: pointer;
        }

        .c-dot.active {
            background: var(--amber);
            width: 20px;
            border-radius: 4px;
        }

        /* ===================== BANNER / CTA SECTION ===================== */
        .banner-sec {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #2A1500 0%, #1A0E00 50%, var(--bg) 100%);
            padding: 100px 0;
        }

        [data-theme="light"] .banner-sec {
            background: linear-gradient(135deg, #FFF0D0 0%, #FFE0A0 40%, var(--bg) 100%);
        }

        .banner-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(245, 166, 35, .2), transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: glowPulse 4s ease-in-out infinite;
        }

        @keyframes glowPulse {

            0%,
            100% {
                opacity: .6;
                transform: translate(-50%, -50%) scale(1)
            }

            50% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1.2)
            }
        }

        .banner-sec h2 {
            font-family: 'Syne', sans-serif;
            font-size: clamp(2rem, 4.5vw, 3.5rem);
            font-weight: 800;
            color: var(--text);
            line-height: 1.12;
        }

        .banner-sec p {
            font-size: 1.05rem;
            color: var(--text2);
            margin-bottom: 36px;
        }

        /* ===================== ABOUT SECTION ===================== */
        .about-sec {
            background: var(--bg2);
        }

        .co-card {
            background: var(--surface);
            border: 1px solid var(--border2);
            border-radius: 24px;
            padding: 36px;
            text-align: center;
        }

        .co-name {
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: var(--amber);
            margin-bottom: 4px;
        }

        .co-name span {
            color: var(--text);
        }

        .co-tag {
            font-size: .82rem;
            color: var(--text3);
        }

        .ab-icon-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 20px;
        }

        .ab-it {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 14px;
            text-align: center;
            font-size: .78rem;
            color: var(--text2);
        }

        .ab-it i {
            display: block;
            font-size: 1.5rem;
            color: var(--amber);
            margin-bottom: 6px;
        }

        .mission-c {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 14px;
        }

        .mission-c h5 {
            font-weight: 700;
            color: var(--amber);
            margin-bottom: 6px;
            font-size: .95rem;
        }

        .mission-c p {
            font-size: .85rem;
            color: var(--text2);
            margin: 0;
            line-height: 1.72;
        }

        .team-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 24px;
            text-align: center;
            transition: .3s;
        }

        .team-card:hover {
            border-color: var(--border2);
            transform: translateY(-4px);
        }

        .team-ava {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.1rem;
            color: #000;
            margin: 0 auto 14px;
        }

        .team-card h4 {
            font-size: .9rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .team-card p {
            font-size: .78rem;
            color: var(--text3);
        }

        .team-card span {
            font-size: .72rem;
            color: var(--amber);
        }

        /* ===================== CONTACT SECTION ===================== */
        .contact-sec {
            background: var(--bg);
        }

        .cform {
            background: var(--surface);
            border: 1px solid var(--border2);
            border-radius: 24px;
            padding: 38px;
        }

        .form-label {
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
            color: var(--text2);
            margin-bottom: 7px;
        }

        .form-control,
        .form-select {
            background: var(--surface2) !important;
            border: 1px solid var(--border2) !important;
            color: var(--text) !important;
            border-radius: 10px !important;
            padding: 11px 15px !important;
            font-size: .88rem !important;
            transition: .3s !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--amber) !important;
            box-shadow: 0 0 0 3px rgba(245, 166, 35, .12) !important;
            background: rgba(245, 166, 35, .04) !important;
            outline: none !important;
        }

        .form-control::placeholder {
            color: var(--text3) !important;
        }

        .form-select option {
            background: var(--bg3);
            color: var(--text);
        }

        .cinfo-card {
            display: flex;
            gap: 14px;
            padding: 18px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            margin-bottom: 12px;
        }

        .ci-ico {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: rgba(245, 166, 35, .12);
            border: 1px solid var(--border2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--amber);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .cinfo-card h6 {
            font-weight: 700;
            font-size: .85rem;
            color: var(--text);
            margin-bottom: 3px;
        }

        .cinfo-card p {
            font-size: .8rem;
            color: var(--text3);
            margin: 0;
        }

        /* ===================== FAQ ===================== */
        .faq-wrap {
            background: var(--bg2);
        }

        .faq-i {
            border: 1px solid var(--border);
            border-radius: 12px;
            margin-bottom: 10px;
            overflow: hidden;
            transition: border-color .3s;
        }

        .faq-i.open {
            border-color: var(--border2);
        }

        .faq-q {
            padding: 18px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            font-size: .92rem;
            color: var(--text);
            background: var(--surface);
            transition: .3s;
        }

        .faq-q:hover {
            background: var(--surface2);
        }

        .faq-q i {
            color: var(--amber);
            font-size: .85rem;
            transition: transform .3s;
        }

        .faq-i.open .faq-q i {
            transform: rotate(45deg);
        }

        .faq-a {
            max-height: 0;
            overflow: hidden;
            transition: .4s ease;
            font-size: .85rem;
            color: var(--text2);
            line-height: 1.78;
            padding: 0 22px;
        }

        .faq-i.open .faq-a {
            max-height: 160px;
            padding: 12px 22px 18px;
        }

        /* ===================== SCROLL REVEAL ===================== */
        .reveal {
            opacity: 0;
            transform: translateY(36px);
            transition: opacity .7s ease, transform .7s ease;
        }

        .reveal.vis {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-l {
            opacity: 0;
            transform: translateX(-36px);
            transition: opacity .7s ease, transform .7s ease;
        }

        .reveal-l.vis {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-r {
            opacity: 0;
            transform: translateX(36px);
            transition: opacity .7s ease, transform .7s ease;
        }

        .reveal-r.vis {
            opacity: 1;
            transform: translateX(0);
        }

        .delay-1 {
            transition-delay: .1s;
        }

        .delay-2 {
            transition-delay: .2s;
        }

        .delay-3 {
            transition-delay: .3s;
        }

        .delay-4 {
            transition-delay: .4s;
        }

        .delay-5 {
            transition-delay: .5s;
        }

        /* ===================== FOOTER ===================== */
        footer {
            background: var(--bg2);
            border-top: 1px solid var(--border);
            padding: 60px 0 24px;
        }

        .foot-logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.7rem;
            font-weight: 800;
            color: var(--amber);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .foot-logo span {
            color: var(--text);
        }

        .foot-desc {
            font-size: .83rem;
            color: var(--text3);
            line-height: 1.78;
            margin-bottom: 20px;
        }

        .foot-h {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--amber);
            margin-bottom: 14px;
        }

        .foot-a {
            display: block;
            font-size: .83rem;
            color: var(--text3);
            text-decoration: none;
            padding: 3px 0;
            transition: .3s;
        }

        .foot-a:hover {
            color: var(--amber);
        }

        .soc-l {
            display: flex;
            gap: 8px;
        }

        .soc-a {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--surface2);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--amber);
            text-decoration: none;
            font-size: .8rem;
            transition: .3s;
        }

        .soc-a:hover {
            background: var(--amber);
            color: #000;
            transform: translateY(-3px);
        }

        .foot-btm {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            font-size: .78rem;
            color: var(--text3);
        }

        /* ===================== TOAST ===================== */
        .toast-n {
            position: fixed;
            bottom: 28px;
            right: 28px;
            background: var(--bg3);
            border: 1px solid var(--teal);
            color: var(--text);
            padding: 14px 22px;
            border-radius: 14px;
            font-size: .88rem;
            z-index: 9999;
            transform: translateX(130%);
            transition: .4s ease;
            backdrop-filter: blur(16px);
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .3);
        }

        .toast-n.show {
            transform: translateX(0);
        }

        .toast-n i {
            color: var(--teal);
            font-size: 1rem;
        }

        /* ===================== PAGE SECTIONS ===================== */
        .pg-sec {
            display: none;
        }

        .pg-sec.active {
            display: block;
        }

        #pg-home {
            display: block;
        }

        /* ===================== SECTION SPECIFIC ===================== */
        .bg-s2 {
            background: var(--bg2);
        }

        /* RESPONSIVE CAROUSEL */
        @media (max-width:991px) {
            .testi-slide {
                flex: 0 0 calc(50% - 20px);
            }
        }

        @media (max-width:600px) {
            .testi-slide {
                flex: 0 0 calc(100% - 20px);
            }
        }

        /* RESPONSIVE NAV */
        @media (max-width:991px) {
            .hero-visual {
                margin-top: 40px;
            }

            .fc1,
            .fc2 {
                display: none;
            }

            .step-line {
                display: none;
            }
        }

        @media (max-width:768px) {
            .testi-slide {
                flex: 0 0 calc(100% - 20px);
            }
        }
    </style>
</head>

<body>

    <!-- CURSOR -->
    <div id="cur-dot"></div>
    <div id="cur-ring"></div>

    <!-- THREE.JS CANVAS -->
    <canvas id="three-canvas"></canvas>

    <!-- ===================== NAVBAR ===================== -->
    <nav id="navbar" class="navbar navbar-expand-lg">
        <div class="container">
            <a class="brand navbar-brand" href="#" onclick="showPage('home');return false;">
                <div class="b-icon"><i class="fas fa-file-invoice"></i></div>
                Go<span class="b-name">School</span>
            </a>
            <div class="d-flex align-items-center gap-3 d-lg-none">
                <div class="toggle-wrap">
                    <div class="theme-toggle" onclick="toggleTheme()" title="Toggle theme">
                        <div class="knob"><i class="fas fa-sun" id="th-icon"></i></div>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end align-items-center gap-2" id="navMenu">
                <ul class="navbar-nav align-items-center gap-1">
                    <li><a class="nav-link active-p" href="#" id="nl-home" onclick="showPage('home');return false;">Home</a></li>
                    <li><a class="nav-link" href="#features" onclick="showPage('home')">Features</a></li>
                    <li><a class="nav-link" href="#pricing" onclick="showPage('home')">Pricing</a></li>
                    <li><a class="nav-link" id="nl-about" href="#" onclick="showPage('about');return false;">About</a></li>
                    <li><a class="nav-link" id="nl-contact" href="#" onclick="showPage('contact');return false;">Contact</a></li>
                    <li class="ms-1"><a class="nav-link btn-try" href="#" onclick="toast('Free demo request sent! We\'ll call you back.');return false;"><i class="fas fa-rocket me-2"></i>Free Demo</a></li>
                </ul>
                <div class="toggle-wrap ms-3 d-none d-lg-flex">
                    <i class="fas fa-moon" style="font-size:.75rem;color:var(--text3)"></i>
                    <div class="theme-toggle" onclick="toggleTheme()">
                        <div class="knob"><i class="fas fa-sun" id="th-icon2"></i></div>
                    </div>
                    <i class="fas fa-sun" style="font-size:.75rem;color:var(--text3)"></i>
                </div>
            </div>
        </div>
    </nav>

    <!-- ===================== HOME PAGE ===================== -->
    <div id="pg-home" class="pg-sec active">

        <!-- HERO -->
        <section class="hero">
            <div class="hero-overlay"></div>
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6 hero-content">
                        <div class="announce-pill">
                            <div class="dot"></div>
                            New Launch — everthings.in
                        </div>
                        <h1 class="hero-title">
                            <div class="line"><span>Forget Paper</span></div>
                            <div class="line"><span>Registers. Go</span></div>
                            <div class="line"><span class="grad-text">Digital Now.</span></div>
                        </h1>
                        <p class="hero-sub">India's smartest school fee &amp; invoice management system. Auto-generate GST invoices, track payments, send WhatsApp receipts — all from one dashboard.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="#" class="btn-primary-g" onclick="toast('Starting your free 30-day trial!');return false;">
                                <i class="fas fa-rocket"></i> Start Free Trial
                            </a>
                            <a href="#features" class="btn-outline-g" onclick="showPage('home')">
                                <i class="fas fa-play-circle"></i> Watch Demo
                            </a>
                        </div>
                        <div class="hero-trust">
                            <div class="trust-item"><i class="fas fa-check-circle"></i> No credit card</div>
                            <div class="trust-item"><i class="fas fa-check-circle"></i> 30-day free trial</div>
                            <div class="trust-item"><i class="fas fa-check-circle"></i> GST compliant</div>
                            <div class="trust-item"><i class="fas fa-check-circle"></i> WhatsApp alerts</div>
                        </div>
                    </div>
                    <div class="col-lg-6 hero-visual">
                        <div style="position:relative;max-width:440px;margin:0 auto;">
                            <div class="float-card fc1">
                                <div class="fc-num">5,000<span style="font-size:.8rem">+</span></div>
                                <div class="fc-desc"><i class="fas fa-school me-1" style="color:var(--amber)"></i>Schools Using</div>
                            </div>
                            <div class="inv-card">
                                <div class="inv-hdr">
                                    <div>
                                        <div class="inv-logo"><i class="fas fa-graduation-cap"></i></div>
                                        <div style="font-size:.6rem;color:var(--text3);margin-top:6px">Delhi Public School</div>
                                    </div>
                                    <div class="text-end">
                                        <div class="inv-lbl">Tax Invoice</div>
                                        <div class="inv-num">#INV-2025-0892</div>
                                        <div class="mt-1"><span class="sbadge s-paid"><i class="fas fa-check me-1"></i>Paid</span></div>
                                    </div>
                                </div>
                                <div style="font-size:.65rem;color:var(--text3);margin-bottom:14px">Academic Year 2024–25 &nbsp;·&nbsp; Quarter 3</div>
                                <div class="inv-row"><span class="lbl">Student Name</span><span class="val">Aryan Sharma</span></div>
                                <div class="inv-row"><span class="lbl">Class &amp; Section</span><span class="val">Class X – A</span></div>
                                <div class="inv-row"><span class="lbl">Admission No.</span><span class="val">DPS-24-1847</span></div>
                                <div class="inv-row"><span class="lbl">Tuition Fee</span><span class="val">₹8,500</span></div>
                                <div class="inv-row"><span class="lbl">Transport</span><span class="val">₹1,200</span></div>
                                <div class="inv-row"><span class="lbl">Lab &amp; Activity</span><span class="val">₹800</span></div>
                                <div class="inv-row"><span class="lbl">GST (18%)</span><span class="val">₹1,890</span></div>
                                <div class="inv-total">
                                    <div>
                                        <div class="tl">Total Amount</div>
                                        <div style="font-size:.6rem;color:var(--text3)">Paid: 05 Jan 2025</div>
                                    </div>
                                    <div class="tv">₹12,390</div>
                                </div>
                                <div class="mt-3 d-flex gap-2 flex-wrap">
                                    <span class="sbadge s-paid"><i class="fas fa-file-pdf me-1"></i>PDF Ready</span>
                                    <span class="sbadge s-pend"><i class="fab fa-whatsapp me-1"></i>Sent to Parent</span>
                                </div>
                            </div>
                            <div class="float-card fc2">
                                <div class="fc-num">98.7%</div>
                                <div class="fc-desc"><i class="fas fa-chart-line me-1" style="color:var(--teal)"></i>Collection Rate</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- STATS STRIP -->
        <div class="stats-strip">
            <div class="container">
                <div class="row g-3 align-items-center">
                    <div class="col-6 col-md-3 reveal delay-1">
                        <div class="stat-box">
                            <div class="sn" data-target="5000" data-suffix="+">0</div>
                            <div class="sd"><i class="fas fa-school me-1"></i>Schools Onboarded</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 reveal delay-2">
                        <div class="stat-box">
                            <div class="sn" data-target="12" data-suffix="L+">0</div>
                            <div class="sd"><i class="fas fa-user-graduate me-1"></i>Students Managed</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 reveal delay-3">
                        <div class="stat-box">
                            <div class="sn" data-target="50" data-suffix="Cr+">0</div>
                            <div class="sd"><i class="fas fa-rupee-sign me-1"></i>Fees Processed</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 reveal delay-4">
                        <div class="stat-box">
                            <div class="sn" data-target="99" data-suffix="%">0</div>
                            <div class="sd"><i class="fas fa-server me-1"></i>Uptime SLA</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAIN vs SOLUTION -->
        <section class="sec-pad ps-wrap">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6 reveal-l">
                        <div class="sec-tag"><i class="fas fa-times-circle me-1"></i>The Old Way</div>
                        <div class="sec-h">Manual Registers Are <span style="color:var(--rose)">Holding</span> You Back</div>
                        <div class="mt-4">
                            <div class="pain-it">
                                <div class="icon flex-shrink-0 mt-1"><i class="fas fa-book"></i></div>
                                <div>
                                    <h5>Handwritten Fee Ledgers</h5>
                                    <p>Hours wasted on paper registers with zero search capability or reporting</p>
                                </div>
                            </div>
                            <div class="pain-it">
                                <div class="icon flex-shrink-0 mt-1"><i class="fas fa-search"></i></div>
                                <div>
                                    <h5>No Real-Time Payment Status</h5>
                                    <p>Staff manually cross-checking who paid and who's defaulting every single day</p>
                                </div>
                            </div>
                            <div class="pain-it">
                                <div class="icon flex-shrink-0 mt-1"><i class="fas fa-phone-slash"></i></div>
                                <div>
                                    <h5>Manual Parent Reminders</h5>
                                    <p>Staff calling each parent individually — wasting hours of valuable school time</p>
                                </div>
                            </div>
                            <div class="pain-it">
                                <div class="icon flex-shrink-0 mt-1"><i class="fas fa-exclamation-triangle"></i></div>
                                <div>
                                    <h5>Data Loss &amp; Tampering Risk</h5>
                                    <p>Paper records damaged, lost or manipulated — audit nightmares every year</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 reveal-r">
                        <div class="sec-tag"><i class="fas fa-check-circle me-1"></i>The GoSchool Way</div>
                        <div class="sec-h">Smart. Automated. <span style="color:var(--teal)">Effortless.</span></div>
                        <div class="mt-4">
                            <div class="sol-it">
                                <div class="icon flex-shrink-0 mt-1"><i class="fas fa-bolt"></i></div>
                                <div>
                                    <h5>Instant Digital Invoices</h5>
                                    <p>Auto-generate branded, GST-compliant invoices in one click with school logo</p>
                                </div>
                            </div>
                            <div class="sol-it">
                                <div class="icon flex-shrink-0 mt-1"><i class="fas fa-tachometer-alt"></i></div>
                                <div>
                                    <h5>Live Payment Dashboard</h5>
                                    <p>See every student's payment status live — paid, pending, overdue at a glance</p>
                                </div>
                            </div>
                            <div class="sol-it">
                                <div class="icon flex-shrink-0 mt-1"><i class="fas fa-bell"></i></div>
                                <div>
                                    <h5>Auto WhatsApp &amp; SMS Alerts</h5>
                                    <p>Reminders go out automatically — reduce fee defaults by up to 70%</p>
                                </div>
                            </div>
                            <div class="sol-it">
                                <div class="icon flex-shrink-0 mt-1"><i class="fas fa-cloud"></i></div>
                                <div>
                                    <h5>Encrypted Cloud Storage</h5>
                                    <p>256-bit encryption, auto-backups. Your data is safe and accessible 24/7</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FEATURES -->
        <section id="features" class="sec-pad">
            <div class="container">
                <div class="text-center mb-5 reveal">
                    <div class="sec-tag">Features</div>
                    <div class="sec-h">Everything Your School <span class="grad-text">Needs</span></div>
                    <p class="sec-sub mx-auto">A complete fee management ecosystem built for Indian schools — from metro to tier-3 towns</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4 reveal delay-1">
                        <div class="feat-card">
                            <div class="feat-num">01</div>
                            <div class="feat-ico"><i class="fas fa-file-invoice"></i></div>
                            <h4>Smart Invoice Generation</h4>
                            <p>Create branded, professional invoices with school logo, GST, student info and fee breakdown in one click.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 reveal delay-2">
                        <div class="feat-card">
                            <div class="feat-num">02</div>
                            <div class="feat-ico"><i class="fas fa-chart-pie"></i></div>
                            <h4>Revenue Dashboard</h4>
                            <p>Visualize fee collection trends, monthly charts, pending amounts and class-wise summaries in real time.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 reveal delay-3">
                        <div class="feat-card">
                            <div class="feat-num">03</div>
                            <div class="feat-ico"><i class="fas fa-bell"></i></div>
                            <h4>Auto Reminder Engine</h4>
                            <p>WhatsApp, SMS and email reminders sent automatically on due dates. Reduce defaults by 70%+.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 reveal delay-1">
                        <div class="feat-card">
                            <div class="feat-num">04</div>
                            <div class="feat-ico"><i class="fas fa-credit-card"></i></div>
                            <h4>Multi-Mode Payments</h4>
                            <p>UPI, Net Banking, Card, Cash — all tracked in one place. Integrated payment gateway included.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 reveal delay-2">
                        <div class="feat-card">
                            <div class="feat-num">05</div>
                            <div class="feat-ico"><i class="fas fa-users"></i></div>
                            <h4>Student Profile Manager</h4>
                            <p>Complete student database with fee history, payment records, documents and parent contacts.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 reveal delay-3">
                        <div class="feat-card">
                            <div class="feat-num">06</div>
                            <div class="feat-ico"><i class="fas fa-receipt"></i></div>
                            <h4>Instant Receipt Generation</h4>
                            <p>Auto-generate digital receipts on payment confirmation. Sent directly to parents via WhatsApp.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 reveal delay-1">
                        <div class="feat-card">
                            <div class="feat-num">07</div>
                            <div class="feat-ico"><i class="fas fa-calculator"></i></div>
                            <h4>Fee Structure Templates</h4>
                            <p>Create class-wise fee structures with different heads — tuition, transport, hostel, lab, activity.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 reveal delay-2">
                        <div class="feat-card">
                            <div class="feat-num">08</div>
                            <div class="feat-ico"><i class="fas fa-file-export"></i></div>
                            <h4>Reports &amp; Excel Export</h4>
                            <p>Daily, monthly, annual reports. Export to Excel or PDF for accounts and audit with one click.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 reveal delay-3">
                        <div class="feat-card">
                            <div class="feat-num">09</div>
                            <div class="feat-ico"><i class="fas fa-shield-alt"></i></div>
                            <h4>Bank-Grade Security</h4>
                            <p>256-bit encryption, role-based access control, automated backups. Your data is always protected.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- WORKFLOW -->
        <section class="sec-pad bg-s2">
            <div class="container">
                <div class="text-center mb-5 reveal">
                    <div class="sec-tag">How It Works</div>
                    <div class="sec-h">Up &amp; Running in <span class="grad-text">4 Steps</span></div>
                    <p class="sec-sub mx-auto">Get your entire school on GoSchool within one business day</p>
                </div>
                <div class="row g-0">
                    <div class="col-6 col-md-3 reveal delay-1">
                        <div class="step-c">
                            <div class="step-n">1</div>
                            <h5>Register School</h5>
                            <p>Create account. Add school name, logo, address and admin contact details.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 reveal delay-2">
                        <div class="step-c">
                            <div class="step-n">2</div>
                            <h5>Add Students</h5>
                            <p>Import via Excel or add individually. Assign class, section and roll number.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 reveal delay-3">
                        <div class="step-c">
                            <div class="step-n">3</div>
                            <h5>Set Fee Structure</h5>
                            <p>Define fee heads and amounts class-wise. Set due dates and discount policies.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 reveal delay-4">
                        <div class="step-c">
                            <div class="step-n">4</div>
                            <h5>Send &amp; Collect</h5>
                            <p>Auto-send invoices, collect payments, generate receipts automatically.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- PRICING -->
        <section id="pricing" class="sec-pad">
            <div class="container">
                <div class="text-center mb-5 reveal">
                    <div class="sec-tag">Pricing</div>
                    <div class="sec-h">Simple &amp; Transparent <span class="grad-text">Pricing</span></div>
                    <p class="sec-sub mx-auto">No hidden charges. Per-school annual plan. Cancel anytime.</p>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-4 reveal delay-1">
                        <div class="price-c">
                            <div class="plan-n">Starter</div>
                            <div class="price-n">₹4,999<span>/yr</span></div>
                            <p style="font-size:.78rem;color:var(--text3);margin:8px 0">Up to 300 students</p>
                            <ul class="feat-ul">
                                <li><i class="fas fa-check"></i>Invoice Generation</li>
                                <li><i class="fas fa-check"></i>Basic Dashboard</li>
                                <li><i class="fas fa-check"></i>Email Receipts</li>
                                <li><i class="fas fa-check"></i>Excel Export</li>
                                <li><i class="fas fa-check"></i>Email Support</li>
                                <li class="dis"><i class="fas fa-times"></i>WhatsApp Integration</li>
                                <li class="dis"><i class="fas fa-times"></i>Payment Gateway</li>
                            </ul>
                            <a href="#" class="btn-p-out" onclick="toast('Redirecting to checkout...');return false;">Get Started</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 reveal delay-2">
                        <div class="price-c feat-price">
                            <div class="popular-tag"><i class="fas fa-star me-1"></i>Most Popular</div>
                            <div class="plan-n">Professional</div>
                            <div class="price-n">₹11,999<span>/yr</span></div>
                            <p style="font-size:.78rem;color:var(--text3);margin:8px 0">Up to 1,000 students</p>
                            <ul class="feat-ul">
                                <li><i class="fas fa-check"></i>Everything in Starter</li>
                                <li><i class="fas fa-check"></i>WhatsApp Integration</li>
                                <li><i class="fas fa-check"></i>Payment Gateway</li>
                                <li><i class="fas fa-check"></i>Auto Reminders</li>
                                <li><i class="fas fa-check"></i>Advanced Reports</li>
                                <li><i class="fas fa-check"></i>Priority Support</li>
                                <li><i class="fas fa-check"></i>Custom Branding</li>
                            </ul>
                            <a href="#" class="btn-p-main" onclick="toast('Starting your Pro trial...');return false;">Start Free Trial</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 reveal delay-3">
                        <div class="price-c">
                            <div class="plan-n">Enterprise</div>
                            <div class="price-n">Custom</div>
                            <p style="font-size:.78rem;color:var(--text3);margin:8px 0">Unlimited students</p>
                            <ul class="feat-ul">
                                <li><i class="fas fa-check"></i>Everything in Pro</li>
                                <li><i class="fas fa-check"></i>Multi-Branch Support</li>
                                <li><i class="fas fa-check"></i>API Access</li>
                                <li><i class="fas fa-check"></i>Custom Integrations</li>
                                <li><i class="fas fa-check"></i>Dedicated Manager</li>
                                <li><i class="fas fa-check"></i>On-site Training</li>
                                <li><i class="fas fa-check"></i>SLA Guarantee</li>
                            </ul>
                            <a href="#" class="btn-p-out" onclick="showPage('contact');return false;">Contact Sales</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TESTIMONIALS CAROUSEL -->
        <section class="sec-pad testi-section">
            <div class="container">
                <div class="text-center mb-5 reveal">
                    <div class="sec-tag">Testimonials</div>
                    <div class="sec-h">Schools <span class="grad-text">Love</span> GoSchool</div>
                </div>
                <div class="carousel-wrapper reveal">
                    <div class="testi-track" id="testiTrack">
                        <!-- Slide 1 -->
                        <div class="testi-slide">
                            <div class="testi-card">
                                <div class="testi-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <p>"We reduced fee defaulters by 68% in the first term. Parents love getting WhatsApp invoices and our accounts team saves 3 hours daily."</p>
                                <div class="testi-author">
                                    <div class="t-ava" style="background:linear-gradient(135deg,#F5A623,#C8820A)">RS</div>
                                    <div>
                                        <div class="t-name">Rajesh Sharma</div>
                                        <div class="t-role"><i class="fas fa-school me-1"></i>Principal, DPS Ranchi</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="testi-slide">
                            <div class="testi-card">
                                <div class="testi-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <p>"Setup was incredibly easy. Within one day our entire fee structure was live. The reporting is superb — our audit is now 100% paperless!"</p>
                                <div class="testi-author">
                                    <div class="t-ava" style="background:linear-gradient(135deg,#2DD4BF,#0D9488)">PK</div>
                                    <div>
                                        <div class="t-name">Priya Kumari</div>
                                        <div class="t-role"><i class="fas fa-user-tie me-1"></i>Admin Manager, Loyola School</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div class="testi-slide">
                            <div class="testi-card">
                                <div class="testi-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <p>"The class-wise collection reports in seconds is exceptional. Audit process became completely paperless. Highly recommend to every school!"</p>
                                <div class="testi-author">
                                    <div class="t-ava" style="background:linear-gradient(135deg,#8B5E45,#5C3D2E)">AM</div>
                                    <div>
                                        <div class="t-name">Anita Mishra</div>
                                        <div class="t-role"><i class="fas fa-calculator me-1"></i>Accounts Head, St. Xavier's</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 4 -->
                        <div class="testi-slide">
                            <div class="testi-card">
                                <div class="testi-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                                <p>"Parents love the WhatsApp receipts. Our fee collection efficiency went from 72% to 96% in the very first quarter after adopting GoSchool."</p>
                                <div class="testi-author">
                                    <div class="t-ava" style="background:linear-gradient(135deg,#7C3AED,#4C1D95)">VT</div>
                                    <div>
                                        <div class="t-name">Vikram Tiwari</div>
                                        <div class="t-role"><i class="fas fa-building me-1"></i>Director, Vidya Mandir Group</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 5 -->
                        <div class="testi-slide">
                            <div class="testi-card">
                                <div class="testi-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <p>"Migrating 1,200 student records was done in 2 hours with their team's help. The customer support is outstanding — truly a 5-star product."</p>
                                <div class="testi-author">
                                    <div class="t-ava" style="background:linear-gradient(135deg,#F43F5E,#BE123C)">SD</div>
                                    <div>
                                        <div class="t-name">Sunita Devi</div>
                                        <div class="t-role"><i class="fas fa-chalkboard-teacher me-1"></i>Principal, Kendriya Vidyalaya</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 6 -->
                        <div class="testi-slide">
                            <div class="testi-card">
                                <div class="testi-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <p>"Multi-branch support is a game changer for us. We manage 3 campuses from a single dashboard. GoSchool is worth every rupee!"</p>
                                <div class="testi-author">
                                    <div class="t-ava" style="background:linear-gradient(135deg,#059669,#065F46)">NK</div>
                                    <div>
                                        <div class="t-name">Nitin Kumar</div>
                                        <div class="t-role"><i class="fas fa-network-wired me-1"></i>IT Head, Cambridge School Group</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-ctrl">
                    <button class="c-btn" id="cPrev" onclick="carouselPrev()"><i class="fas fa-chevron-left"></i></button>
                    <div class="c-dots" id="cDots"></div>
                    <button class="c-btn" id="cNext" onclick="carouselNext()"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="sec-pad faq-wrap">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-4 reveal">
                            <div class="sec-tag">FAQ</div>
                            <div class="sec-h">Common <span class="grad-text">Questions</span></div>
                        </div>
                        <div class="faq-i reveal">
                            <div class="faq-q" onclick="toggleFaq(this)"><span>How long does it take to set up GoSchool?</span><i class="fas fa-plus"></i></div>
                            <div class="faq-a">Most schools are fully live within 1 business day. Our onboarding team guides you through importing student data, configuring fee structures, and customizing invoice templates step by step.</div>
                        </div>
                        <div class="faq-i reveal delay-1">
                            <div class="faq-q" onclick="toggleFaq(this)"><span>Can we import our existing student data?</span><i class="fas fa-plus"></i></div>
                            <div class="faq-a">Yes! Import via Excel or CSV in any format. Our team assists with data migration at zero extra cost. We support all common student management formats including Tally, ERP, and custom Excel sheets.</div>
                        </div>
                        <div class="faq-i reveal delay-2">
                            <div class="faq-q" onclick="toggleFaq(this)"><span>Is GST invoicing fully supported?</span><i class="fas fa-plus"></i></div>
                            <div class="faq-a">Absolutely. GoSchool generates fully GST-compliant invoices with GSTIN, HSN codes, tax breakdowns, place of supply and all fields required for educational institutions under GST rules.</div>
                        </div>
                        <div class="faq-i reveal delay-3">
                            <div class="faq-q" onclick="toggleFaq(this)"><span>Can parents pay online directly?</span><i class="fas fa-plus"></i></div>
                            <div class="faq-a">Yes! Pro and Enterprise plans include an integrated payment gateway supporting UPI, Net Banking, Credit/Debit cards and wallets. Parents pay directly from the invoice link on mobile or desktop.</div>
                        </div>
                        <div class="faq-i reveal delay-4">
                            <div class="faq-q" onclick="toggleFaq(this)"><span>What happens to our data if we cancel?</span><i class="fas fa-plus"></i></div>
                            <div class="faq-a">You own your data. On cancellation we provide a complete export of all records in Excel and PDF. Data is retained securely for 90 days post-cancellation before permanent deletion.</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- BANNER CTA -->
        <section class="banner-sec">
            <div class="banner-glow"></div>
            <div class="container text-center" style="position:relative;z-index:2">
                <div class="reveal">
                    <div class="sec-tag justify-content-center">Get Started Today</div>
                    <h2 class="sec-h" style="max-width:600px;margin:0 auto 16px">Ready to Transform Your School's <span class="grad-text">Fee Management?</span></h2>
                    <p>Join 5,000+ schools saving time and money with GoSchool. Setup takes less than a day.</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="#" class="btn-primary-g" onclick="toast('Starting your free 30-day trial!');return false;"><i class="fas fa-rocket"></i>Start Free 30-Day Trial</a>
                        <a href="#" class="btn-outline-g" onclick="showPage('contact');return false;"><i class="fas fa-phone-alt"></i>Talk to Sales</a>
                    </div>
                    <p style="font-size:.78rem;color:var(--text3);margin-top:18px">No credit card required &nbsp;·&nbsp; Cancel anytime &nbsp;·&nbsp; Full support included</p>
                </div>
            </div>
        </section>

    </div><!-- /HOME -->

    <!-- ===================== ABOUT PAGE ===================== -->
    <div id="pg-about" class="pg-sec">
        <section class="about-sec sec-pad" style="padding-top:120px">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5 reveal-l">
                        <div class="co-card">
                            <div class="co-name"><i class="fas fa-file-invoice me-2"></i>Go<span>School</span></div>
                            <div class="co-tag"><i class="fas fa-map-marker-alt me-1"></i>by everthings.in — Ranchi, Jharkhand</div>
                            <div class="ab-icon-grid mt-4">
                                <div class="ab-it"><i class="fas fa-school"></i>5,000+ Schools</div>
                                <div class="ab-it"><i class="fas fa-users"></i>12L+ Students</div>
                                <div class="ab-it"><i class="fas fa-rupee-sign"></i>₹50Cr+ Processed</div>
                                <div class="ab-it"><i class="fas fa-map-pin"></i>Pan India</div>
                            </div>
                        </div>
                        <div class="mt-3 row g-2">
                            <div class="col-4">
                                <div style="background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:14px;text-align:center;font-size:.75rem;color:var(--text2)"><i class="fas fa-award d-block mb-1" style="color:var(--amber);font-size:1.4rem"></i>ISO Certified</div>
                            </div>
                            <div class="col-4">
                                <div style="background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:14px;text-align:center;font-size:.75rem;color:var(--text2)"><i class="fas fa-lock d-block mb-1" style="color:var(--teal);font-size:1.4rem"></i>256-bit SSL</div>
                            </div>
                            <div class="col-4">
                                <div style="background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:14px;text-align:center;font-size:.75rem;color:var(--text2)"><i class="fas fa-certificate d-block mb-1" style="color:var(--rose);font-size:1.4rem"></i>GST Verified</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 reveal-r">
                        <div class="sec-tag">About Us</div>
                        <div class="sec-h">We Are <span class="grad-text">everthings.in</span></div>
                        <p style="color:var(--text2);line-height:1.85;margin-bottom:20px">Based in Ranchi, Jharkhand, everthings.in is a technology company on a mission to digitize India's education administration. Founded by engineers and educators, we deeply understand school management pain points.</p>
                        <p style="color:var(--text2);line-height:1.85;margin-bottom:28px">GoSchool is our flagship product — a comprehensive fee management and invoice system designed for Indian schools, with GST support, multi-payment modes, regional integration, and deep WhatsApp connectivity.</p>
                        <div class="mission-c">
                            <h5><i class="fas fa-bullseye me-2"></i>Our Mission</h5>
                            <p>Eliminate manual paperwork from every Indian school and give administrators more time for what truly matters — education.</p>
                        </div>
                        <div class="mission-c">
                            <h5><i class="fas fa-eye me-2"></i>Our Vision</h5>
                            <p>A future where every school from metro cities to tier-3 towns has enterprise-grade digital infrastructure at affordable prices.</p>
                        </div>
                        <div class="mission-c">
                            <h5><i class="fas fa-heart me-2"></i>Our Values</h5>
                            <p>Simplicity, reliability, transparency, and an obsession with customer success. We succeed only when schools succeed.</p>
                        </div>
                    </div>
                </div>
                <!-- TEAM -->
                <div class="mt-5 pt-3">
                    <div class="text-center mb-4 reveal">
                        <div class="sec-tag">Our Team</div>
                        <div class="sec-h">The People Behind <span class="grad-text">GoSchool</span></div>
                    </div>
                    <div class="row g-4 justify-content-center">
                        <div class="col-6 col-md-3 reveal delay-1">
                            <div class="team-card">
                                <div class="team-ava" style="background:linear-gradient(135deg,var(--amber),var(--amber-d))">AK</div>
                                <h4>Abhishek Kumar</h4>
                                <p>Founder &amp; CEO</p><span><i class="fas fa-briefcase me-1"></i>10+ yrs EdTech</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 reveal delay-2">
                            <div class="team-card">
                                <div class="team-ava" style="background:linear-gradient(135deg,var(--teal),#0D9488)">RS</div>
                                <h4>Riya Singh</h4>
                                <p>Chief Technology Officer</p><span><i class="fas fa-code me-1"></i>Full-Stack Expert</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 reveal delay-3">
                            <div class="team-card">
                                <div class="team-ava" style="background:linear-gradient(135deg,#8B5E45,#5C3D2E)">VM</div>
                                <h4>Vikram Mahato</h4>
                                <p>Head of Sales</p><span><i class="fas fa-handshake me-1"></i>School Relations</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 reveal delay-4">
                            <div class="team-card">
                                <div class="team-ava" style="background:linear-gradient(135deg,var(--rose),#BE123C)">PD</div>
                                <h4>Pooja Devi</h4>
                                <p>Lead UX Designer</p><span><i class="fas fa-palette me-1"></i>Product Design</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ===================== CONTACT PAGE ===================== -->
    <div id="pg-contact" class="pg-sec">
        <section class="contact-sec sec-pad" style="padding-top:120px">
            <div class="container">
                <div class="text-center mb-5 reveal">
                    <div class="sec-tag">Get In Touch</div>
                    <div class="sec-h">Let's Talk <span class="grad-text">School Fees</span></div>
                    <p class="sec-sub mx-auto">Free demo, pricing query, or just need support — we're here for you</p>
                </div>
                <div class="row g-5">
                    <div class="col-lg-4 reveal-l">
                        <div class="cinfo-card">
                            <div class="ci-ico"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <h6>Office</h6>
                                <p>Harmu Housing Colony, Ranchi, Jharkhand — 834002</p>
                            </div>
                        </div>
                        <div class="cinfo-card">
                            <div class="ci-ico"><i class="fas fa-phone-alt"></i></div>
                            <div>
                                <h6>Phone / WhatsApp</h6>
                                <p>+91 98765 43210<br>+91 87654 32109</p>
                            </div>
                        </div>
                        <div class="cinfo-card">
                            <div class="ci-ico"><i class="fas fa-envelope"></i></div>
                            <div>
                                <h6>Email</h6>
                                <p>hello@everthings.in<br>support@goschool.in</p>
                            </div>
                        </div>
                        <div class="cinfo-card">
                            <div class="ci-ico"><i class="fas fa-clock"></i></div>
                            <div>
                                <h6>Hours</h6>
                                <p>Mon–Sat: 9AM–7PM<br>Sunday: 10AM–4PM</p>
                            </div>
                        </div>
                        <div class="soc-l mt-3">
                            <a href="#" class="soc-a"><i class="fab fa-whatsapp"></i></a>
                            <a href="#" class="soc-a"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="soc-a"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="soc-a"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="soc-a"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-8 reveal-r">
                        <div class="cform">
                            <h4 style="font-family:'Syne',sans-serif;margin-bottom:4px;color:var(--text)"><i class="fas fa-paper-plane me-2" style="color:var(--amber)"></i>Send a Message</h4>
                            <p style="font-size:.82rem;color:var(--text3);margin-bottom:26px">We reply within 2 business hours</p>
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">School Name *</label><input type="text" class="form-control" placeholder="e.g. Delhi Public School"></div>
                                <div class="col-md-6"><label class="form-label">Your Name *</label><input type="text" class="form-control" placeholder="Principal / Admin Name"></div>
                                <div class="col-md-6"><label class="form-label">Phone Number *</label><input type="tel" class="form-control" placeholder="+91 XXXXX XXXXX"></div>
                                <div class="col-md-6"><label class="form-label">Email Address</label><input type="email" class="form-control" placeholder="your@school.edu.in"></div>
                                <div class="col-md-6">
                                    <label class="form-label">No. of Students</label>
                                    <select class="form-select">
                                        <option>Select range</option>
                                        <option>Under 200</option>
                                        <option>200 – 500</option>
                                        <option>500 – 1,000</option>
                                        <option>1,000 – 3,000</option>
                                        <option>3,000+</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Inquiry Type</label>
                                    <select class="form-select">
                                        <option>Select type</option>
                                        <option>Free Demo Request</option>
                                        <option>Pricing Query</option>
                                        <option>Technical Support</option>
                                        <option>Partnership</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div class="col-12"><label class="form-label">Message</label><textarea class="form-control" rows="4" placeholder="Tell us about your school and what you're looking for..."></textarea></div>
                                <div class="col-12">
                                    <button class="btn-primary-g w-100 justify-content-center" style="border:none;font-family:'Plus Jakarta Sans',sans-serif;cursor:pointer;" onclick="toast('Message sent! We\'ll contact you within 2 hours.');showPage('home')">
                                        <i class="fas fa-paper-plane"></i>Send Message &amp; Request Demo
                                    </button>
                                    <p style="font-size:.72rem;color:var(--text3);margin-top:10px;text-align:center"><i class="fas fa-lock me-1"></i>We never share your data. Privacy guaranteed.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ===================== FOOTER ===================== -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="foot-logo">
                        <div class="b-icon" style="width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,var(--amber),var(--amber-d));display:flex;align-items:center;justify-content:center;color:#000;font-size:.8rem"><i class="fas fa-file-invoice"></i></div>Go<span>School</span>
                    </div>
                    <div class="foot-desc">India's most loved school fee &amp; invoice management. Built by everthings.in, proudly from Jharkhand.</div>
                    <div class="soc-l">
                        <a href="#" class="soc-a"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="soc-a"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="soc-a"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="soc-a"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="foot-h">Product</div>
                    <a class="foot-a" href="#features" onclick="showPage('home')">Features</a>
                    <a class="foot-a" href="#pricing" onclick="showPage('home')">Pricing</a>
                    <a class="foot-a" href="#">Changelog</a>
                    <a class="foot-a" href="#">API Docs</a>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="foot-h">Company</div>
                    <a class="foot-a" href="#" onclick="showPage('about');return false;">About Us</a>
                    <a class="foot-a" href="#" onclick="showPage('contact');return false;">Contact</a>
                    <a class="foot-a" href="#">Blog</a>
                    <a class="foot-a" href="#">Careers</a>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="foot-h">Support</div>
                    <a class="foot-a" href="#">Help Center</a>
                    <a class="foot-a" href="#">Video Tutorials</a>
                    <a class="foot-a" href="#">Live Chat</a>
                    <a class="foot-a" href="#">Status Page</a>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="foot-h">Legal</div>
                    <a class="foot-a" href="#">Privacy Policy</a>
                    <a class="foot-a" href="#">Terms of Service</a>
                    <a class="foot-a" href="#">Refund Policy</a>
                    <a class="foot-a" href="#">GDPR</a>
                </div>
            </div>
            <div class="foot-btm">
                <span>&copy; 2025 everthings.in — GoSchool. All rights reserved. GST: 20XXXXX1234Z1A</span>
                <span style="color:var(--amber)"><i class="fas fa-heart me-1"></i>Made in Jharkhand, India</span>
            </div>
        </div>
    </footer>

    <!-- TOAST -->
    <div class="toast-n" id="toastEl"><i class="fas fa-check-circle"></i><span id="toastMsg">Done!</span></div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script>
        /* ===================== THREE.JS SCENE ===================== */
        (function() {
            const canvas = document.getElementById('three-canvas');
            const renderer = new THREE.WebGLRenderer({
                canvas,
                alpha: true,
                antialias: true
            });
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            renderer.setSize(window.innerWidth, window.innerHeight);

            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.z = 30;

            // PARTICLE FIELD
            const count = 1800;
            const geo = new THREE.BufferGeometry();
            const pos = new Float32Array(count * 3);
            const col = new Float32Array(count * 3);
            for (let i = 0; i < count; i++) {
                pos[i * 3] = (Math.random() - 0.5) * 100;
                pos[i * 3 + 1] = (Math.random() - 0.5) * 100;
                pos[i * 3 + 2] = (Math.random() - 0.5) * 60;
                const t = Math.random();
                // amber to teal gradient
                col[i * 3] = 0.96 * t + 0.18 * (1 - t);
                col[i * 3 + 1] = 0.65 * t + 0.83 * (1 - t);
                col[i * 3 + 2] = 0.14 * t + 0.75 * (1 - t);
            }
            geo.setAttribute('position', new THREE.BufferAttribute(pos, 3));
            geo.setAttribute('color', new THREE.BufferAttribute(col, 3));
            const mat = new THREE.PointsMaterial({
                size: 0.18,
                vertexColors: true,
                transparent: true,
                opacity: 0.7
            });
            const points = new THREE.Points(geo, mat);
            scene.add(points);

            // LARGE TORUS
            const tGeo = new THREE.TorusGeometry(18, 0.08, 8, 180);
            const tMat = new THREE.MeshBasicMaterial({
                color: 0xF5A623,
                transparent: true,
                opacity: 0.06
            });
            const torus = new THREE.Mesh(tGeo, tMat);
            scene.add(torus);

            // SMALLER RING
            const r2Geo = new THREE.TorusGeometry(11, 0.05, 8, 120);
            const r2Mat = new THREE.MeshBasicMaterial({
                color: 0x2DD4BF,
                transparent: true,
                opacity: 0.07
            });
            const ring2 = new THREE.Mesh(r2Geo, r2Mat);
            ring2.rotation.x = Math.PI / 4;
            scene.add(ring2);

            // OCTAHEDRON WIREFRAME
            const oGeo = new THREE.OctahedronGeometry(8, 0);
            const oMat = new THREE.MeshBasicMaterial({
                color: 0xF5A623,
                wireframe: true,
                transparent: true,
                opacity: 0.04
            });
            const oct = new THREE.Mesh(oGeo, oMat);
            scene.add(oct);

            // MOUSE
            let mx = 0,
                my = 0;
            document.addEventListener('mousemove', e => {
                mx = (e.clientX / window.innerWidth - 0.5) * 2;
                my = -(e.clientY / window.innerHeight - 0.5) * 2;
            });

            window.addEventListener('resize', () => {
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, window.innerHeight);
            });

            let t = 0;

            function animate() {
                requestAnimationFrame(animate);
                t += 0.004;
                points.rotation.y = t * 0.1;
                points.rotation.x = t * 0.05;
                torus.rotation.z = t * 0.08;
                torus.rotation.x = Math.sin(t * 0.3) * 0.2;
                ring2.rotation.y = t * 0.12;
                ring2.rotation.z = Math.cos(t * 0.25) * 0.15;
                oct.rotation.x = t * 0.07;
                oct.rotation.y = t * 0.1;

                // Mouse parallax
                camera.position.x += (mx * 3 - camera.position.x) * 0.03;
                camera.position.y += (my * 2 - camera.position.y) * 0.03;
                camera.lookAt(scene.position);
                renderer.render(scene, camera);
            }
            animate();
        })();

        /* ===================== CURSOR ===================== */
        const dot = document.getElementById('cur-dot');
        const ring = document.getElementById('cur-ring');
        document.addEventListener('mousemove', e => {
            dot.style.left = e.clientX + 'px';
            dot.style.top = e.clientY + 'px';
            setTimeout(() => {
                ring.style.left = e.clientX + 'px';
                ring.style.top = e.clientY + 'px';
            }, 80);
        });
        document.querySelectorAll('a,button,.faq-q,.theme-toggle,.c-btn').forEach(el => {
            el.addEventListener('mouseenter', () => document.body.classList.add('cursor-hover'));
            el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-hover'));
        });

        /* ===================== NAVBAR SCROLL ===================== */
        window.addEventListener('scroll', () => {
            document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 60);
        });

        /* ===================== SCROLL REVEAL ===================== */
        const revObs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('vis');
            });
        }, {
            threshold: 0.12
        });

        function initReveal() {
            document.querySelectorAll('.reveal,.reveal-l,.reveal-r').forEach(el => {
                el.classList.remove('vis');
                revObs.observe(el);
            });
        }
        initReveal();

        /* ===================== COUNTER ===================== */
        const cntObs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting && !e.target.dataset.done) {
                    e.target.dataset.done = '1';
                    const el = e.target.querySelector('[data-target]');
                    if (!el) return;
                    const target = +el.dataset.target,
                        suf = el.dataset.suffix || '';
                    let v = 0;
                    const step = target / 70;
                    const t = setInterval(() => {
                        v = Math.min(v + step, target);
                        el.textContent = Math.floor(v) + suf;
                        if (v >= target) clearInterval(t);
                    }, 22);
                }
            });
        }, {
            threshold: 0.5
        });
        document.querySelectorAll('.stat-box').forEach(el => cntObs.observe(el));

        /* ===================== PAGE NAV ===================== */
        function showPage(pg) {
            document.querySelectorAll('.pg-sec').forEach(s => s.classList.remove('active'));
            document.getElementById('pg-' + pg).classList.add('active');
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active-p'));
            const nl = document.getElementById('nl-' + pg);
            if (nl) nl.classList.add('active-p');
            setTimeout(initReveal, 100);
            // Smooth section scroll if needed
        }

        /* ===================== FAQ ===================== */
        function toggleFaq(el) {
            const item = el.parentElement;
            const was = item.classList.contains('open');
            document.querySelectorAll('.faq-i').forEach(f => f.classList.remove('open'));
            if (!was) item.classList.add('open');
        }

        /* ===================== TOAST ===================== */
        function toast(msg) {
            const el = document.getElementById('toastEl');
            document.getElementById('toastMsg').textContent = msg;
            el.classList.add('show');
            setTimeout(() => el.classList.remove('show'), 3600);
        }

        /* ===================== THEME TOGGLE ===================== */
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.getAttribute('data-theme') === 'dark';
            html.setAttribute('data-theme', isDark ? 'light' : 'dark');
            document.querySelectorAll('#th-icon,#th-icon2').forEach(ic => {
                ic.className = isDark ? 'fas fa-moon' : 'fas fa-sun';
            });
        }

        /* ===================== TESTIMONIALS CAROUSEL ===================== */
        let carPos = 0;
        const slides = document.querySelectorAll('.testi-slide');
        let visibleCount = () => window.innerWidth < 600 ? 1 : window.innerWidth < 992 ? 2 : 3;
        const totalSlides = slides.length;
        const dots = document.getElementById('cDots');

        function buildDots() {
            dots.innerHTML = '';
            const pages = Math.ceil(totalSlides / visibleCount());
            for (let i = 0; i < pages; i++) {
                const d = document.createElement('div');
                d.className = 'c-dot' + (i === 0 ? ' active' : '');
                d.onclick = () => goCarousel(i);
                dots.appendChild(d);
            }
        }

        function goCarousel(page) {
            carPos = page;
            const vc = visibleCount();
            const offset = page * (100 / vc) * (vc);
            const slideW = 100 / vc;
            document.getElementById('testiTrack').style.transform = `translateX(-${page*(slideW*vc)}%)`;
            dots.querySelectorAll('.c-dot').forEach((d, i) => d.classList.toggle('active', i === page));
        }

        function carouselPrev() {
            const pages = Math.ceil(totalSlides / visibleCount());
            goCarousel((carPos - 1 + pages) % pages);
        }

        function carouselNext() {
            const pages = Math.ceil(totalSlides / visibleCount());
            goCarousel((carPos + 1) % pages);
        }
        window.addEventListener('resize', () => {
            carPos = 0;
            buildDots();
            goCarousel(0);
        });
        buildDots();

        // Auto advance
        setInterval(carouselNext, 5000);

        /* ===================== SMOOTH SECTION ANCHOR ===================== */
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', function(e) {
                const id = this.getAttribute('href');
                if (id === '#' || !id) return;
                const t = document.querySelector(id);
                if (t) {
                    e.preventDefault();
                    t.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>