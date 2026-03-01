<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoSchool — Complete School Management System | everthings.in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ═══════════════════════════════════════════
   DESIGN TOKENS
═══════════════════════════════════════════ */
        :root {
            --amber: #F59E0B;
            --amber-l: #FCD34D;
            --amber-d: #B45309;
            --teal: #14B8A6;
            --rose: #F43F5E;
            --indigo: #6366F1;
            --indigo-l: #A5B4FC;
            --green: #10B981;
            --r: 14px;
            --tr: 0.3s ease;
        }

        [data-theme="light"] {
            --bg: #FAFAF7;
            --bg2: #F3F0E8;
            --bg3: #EDE8DA;
            --surface: rgba(0, 0, 0, 0.035);
            --surface2: rgba(0, 0, 0, 0.06);
            --border: rgba(180, 110, 0, 0.13);
            --border2: rgba(180, 110, 0, 0.26);
            --text: #1C1609;
            --text2: rgba(28, 22, 9, 0.58);
            --text3: rgba(28, 22, 9, 0.32);
            --shadow: 0 8px 40px rgba(180, 110, 0, 0.1);
            --navbar: rgba(250, 250, 247, 0.94);
            --card: #FFFFFF;
            --card2: #FFF8EE;
        }

        [data-theme="dark"] {
            --bg: #0D0B06;
            --bg2: #161208;
            --bg3: #201810;
            --surface: rgba(255, 255, 255, 0.04);
            --surface2: rgba(255, 255, 255, 0.07);
            --border: rgba(245, 166, 35, 0.13);
            --border2: rgba(245, 166, 35, 0.26);
            --text: #F5F0E6;
            --text2: rgba(245, 240, 230, 0.58);
            --text3: rgba(245, 240, 230, 0.32);
            --shadow: 0 8px 40px rgba(0, 0, 0, 0.5);
            --navbar: rgba(13, 11, 6, 0.94);
            --card: #1A1610;
            --card2: #201A0E;
        }

        /* ═══════════════════════════════════════════
   BASE
═══════════════════════════════════════════ */
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        html {
            scroll-behavior: smooth
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            transition: background var(--tr), color var(--tr);
            overflow-x: hidden;
            /* No cursor:none on mobile */
        }

        @media(pointer:fine) {
            body {
                cursor: none
            }
        }

        ::selection {
            background: var(--amber);
            color: #000
        }

        img {
            max-width: 100%;
            display: block
        }

        ::-webkit-scrollbar {
            width: 5px
        }

        ::-webkit-scrollbar-track {
            background: var(--bg)
        }

        ::-webkit-scrollbar-thumb {
            background: var(--amber-d);
            border-radius: 3px
        }

        /* ═══════════════════════════════════════════
   CUSTOM CURSOR — only on desktop
═══════════════════════════════════════════ */
        #cur-d,
        #cur-r {
            position: fixed;
            pointer-events: none;
            z-index: 99999;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            will-change: left, top;
            display: none;
            /* hidden by default, shown via JS on pointer:fine */
        }

        #cur-d {
            width: 9px;
            height: 9px;
            background: var(--amber);
            transition: width .15s, height .15s, background .15s;
        }

        #cur-r {
            width: 34px;
            height: 34px;
            border: 1.5px solid var(--amber);
            opacity: .45;
            transition: width .2s, height .2s, opacity .2s;
        }

        /* ═══════════════════════════════════════════
   CANVAS BG (lightweight CSS-driven)
═══════════════════════════════════════════ */
        .bg-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            animation: orbFloat 12s ease-in-out infinite;
        }

        .orb1 {
            width: 500px;
            height: 500px;
            background: rgba(245, 158, 11, 0.08);
            top: -100px;
            right: -100px;
            animation-delay: 0s
        }

        .orb2 {
            width: 400px;
            height: 400px;
            background: rgba(20, 184, 166, 0.06);
            bottom: -80px;
            left: -80px;
            animation-delay: -4s
        }

        .orb3 {
            width: 300px;
            height: 300px;
            background: rgba(99, 102, 241, 0.05);
            top: 40%;
            left: 30%;
            animation-delay: -8s
        }

        [data-theme="dark"] .orb1 {
            background: rgba(245, 158, 11, 0.12)
        }

        [data-theme="dark"] .orb2 {
            background: rgba(20, 184, 166, 0.09)
        }

        [data-theme="dark"] .orb3 {
            background: rgba(99, 102, 241, 0.07)
        }

        @keyframes orbFloat {

            0%,
            100% {
                transform: translate(0, 0) scale(1)
            }

            33% {
                transform: translate(30px, -20px) scale(1.05)
            }

            66% {
                transform: translate(-20px, 25px) scale(0.97)
            }
        }

        /* Dot grid pattern */
        .bg-grid {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, var(--border) 1px, transparent 1px);
            background-size: 32px 32px;
            opacity: .5;
        }

        /* ═══════════════════════════════════════════
   NAVBAR
═══════════════════════════════════════════ */
        #navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 16px 0;
            transition: all .35s ease;
        }

        #navbar.scrolled {
            background: var(--navbar);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
            box-shadow: var(--shadow);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 9px;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--text) !important;
            text-decoration: none;
            letter-spacing: -.3px;
        }

        .brand-ico {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            flex-shrink: 0;
            background: linear-gradient(135deg, var(--amber), var(--amber-d));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-size: .85rem;
        }

        .brand span {
            color: var(--amber)
        }

        .nav-link {
            font-size: .8rem;
            font-weight: 600;
            letter-spacing: .4px;
            text-transform: uppercase;
            color: var(--text2) !important;
            padding: 7px 12px !important;
            position: relative;
            transition: color .25s !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            width: 0;
            height: 1.5px;
            background: var(--amber);
            transition: .25s;
            transform: translateX(-50%);
        }

        .nav-link:hover {
            color: var(--amber) !important
        }

        .nav-link:hover::after,
        .nav-link.np-active::after {
            width: 50%
        }

        .nav-link.np-active {
            color: var(--amber) !important
        }

        .btn-demo {
            background: linear-gradient(135deg, var(--amber), var(--amber-d));
            color: #ffffff !important;
            padding: 9px 20px !important;
            border-radius: 50px;
            font-weight: 700 !important;
            font-size: .8rem !important;
            box-shadow: 0 4px 16px rgba(245, 158, 11, .3);
            transition: all .25s !important;
        }

        .btn-demo::after {
            display: none !important
        }

        .btn-demo:hover {
            transform: translateY(-2px);
            color: #fff !important;
            box-shadow: 0 8px 24px rgba(245, 158, 11, .45) !important
        }

        .btn-login {
            background: linear-gradient(135deg, var(--indigo), var(--indigo-l));
            color: #ffffff !important;
            padding: 9px 20px !important;
            border-radius: 50px;
            font-weight: 700 !important;
            font-size: .8rem !important;
            box-shadow: 0 4px 16px rgba(245, 158, 11, .3);
            transition: all .25s !important;
        }

        .btn-login::after {
            display: none !important
        }

        .btn-login:hover {
            transform: translateY(-2px);
            color: #fff !important;
            box-shadow: 0 8px 24px rgba(245, 158, 11, .45) !important
        }

        /* Theme toggle */
        .th-btn {
            width: 38px;
            height: 22px;
            border-radius: 11px;
            border: 1.5px solid var(--border2);
            background: var(--surface2);
            cursor: pointer;
            position: relative;
            transition: background .3s;
            flex-shrink: 0;
        }

        .th-knob {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: var(--amber);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .5rem;
            color: #000;
            transition: left .3s ease;
        }

        [data-theme="dark"] .th-knob {
            left: 18px
        }

        /* Mobile nav */
        .navbar-toggler {
            border: 1px solid var(--border2) !important;
            padding: 5px 9px !important
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(245,158,11,0.9)' stroke-linecap='round' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important
        }

        @media(max-width:991px) {
            .navbar-collapse {
                background: var(--navbar);
                border-radius: 12px;
                padding: 14px;
                margin-top: 8px;
                border: 1px solid var(--border);
                backdrop-filter: blur(20px);
            }
        }

        /* ═══════════════════════════════════════════
   HERO CAROUSEL
═══════════════════════════════════════════ */
        .hero {
            width: 100%;
            min-height: 100vh;
            position: relative;
            padding-top: 74px;
            overflow: hidden;
            display: block;
        }

        /* The outer clip viewport — fills 100vw edge to edge */
        .hero-viewport {
            width: 100vw;
            margin-left: calc(50% - 50vw);
            overflow: hidden;
            position: relative;
        }

        /* The scrolling track — all slides side by side */
        .hero-track {
            display: flex;
            width: 100%;
            transition: transform .65s cubic-bezier(.4, 0, .2, 1);
            will-change: transform;
        }

        /* Slides container */
        .hero-slides {
            position: relative;
            width: 100%;
            /* min-height: calc(100vh - 80px) */
        }

        .hero-slide {
            padding: 48px 0 32px;
            flex: 0 0 100%;
            width: 100%;
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            opacity: 0;
            transition: opacity .7s ease, transform .7s ease;
            pointer-events: none;
            transform: translateX(40px);
        }

        .hero-slide.active {
            opacity: 1;
            pointer-events: all;
            position: relative;
            transform: translateX(0);
        }

        .hero-slide.exit {
            opacity: 0;
            transform: translateX(-40px);
        }

        /* Slide accent colors */
        .slide-accent-0 {
            --acc: var(--amber);
            --acc-d: var(--amber-d);
            --acc-l: var(--amber-l)
        }

        .slide-accent-1 {
            --acc: var(--teal);
            --acc-d: #0D9488;
            --acc-l: #5EEAD4
        }

        .slide-accent-2 {
            --acc: var(--indigo);
            --acc-d: #4338CA;
            --acc-l: #A5B4FC
        }

        .slide-accent-3 {
            --acc: var(--rose);
            --acc-d: #BE123C;
            --acc-l: #FDA4AF
        }

        .slide-accent-4 {
            --acc: var(--green);
            --acc-d: #059669;
            --acc-l: #6EE7B7
        }

        .announce-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: color-mix(in srgb, var(--acc) 12%, transparent);
            border: 1px solid color-mix(in srgb, var(--acc) 35%, transparent);
            color: var(--acc);
            padding: 5px 16px 5px 8px;
            border-radius: 50px;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 22px;
        }

        .pill-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--acc);
            animation: pulseDot 1.8s infinite;
        }

        @keyframes pulseDot {

            0%,
            100% {
                box-shadow: 0 0 0 0 color-mix(in srgb, var(--acc) 50%, transparent)
            }

            50% {
                box-shadow: 0 0 0 5px transparent
            }
        }

        .hero-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: clamp(2rem, 5vw, 4.2rem);
            line-height: 1.08;
            margin-bottom: 18px;
            color: var(--text);
        }

        .hero-title .accent {
            color: var(--acc)
        }

        .hero-desc {
            font-size: clamp(.9rem, 2vw, 1.05rem);
            color: var(--text2);
            line-height: 1.8;
            max-width: 480px;
            margin-bottom: 28px;
        }

        .btn-hero-pri {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--acc), var(--acc-d));
            color: #000;
            font-weight: 700;
            font-size: .9rem;
            padding: 13px 28px;
            border-radius: 50px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 8px 28px color-mix(in srgb, var(--acc) 35%, transparent);
            transition: all .25s;
        }

        .btn-hero-pri:hover {
            transform: translateY(-2px);
            color: #000;
            box-shadow: 0 14px 36px color-mix(in srgb, var(--acc) 45%, transparent)
        }

        .btn-hero-sec {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: transparent;
            color: var(--text);
            font-weight: 600;
            font-size: .88rem;
            padding: 12px 24px;
            border-radius: 50px;
            border: 1.5px solid var(--border2);
            text-decoration: none;
            cursor: pointer;
            transition: all .25s;
        }

        .btn-hero-sec:hover {
            border-color: var(--acc);
            color: var(--acc)
        }

        .hero-badges {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 22px;
        }

        .h-badge {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: .75rem;
            color: var(--text3);
        }

        .h-badge i {
            color: var(--teal);
            font-size: .75rem
        }

        /* HERO VISUAL CARDS — different per slide */
        .hero-visual {
            position: relative;
            animation: heroFloat 4s ease-in-out infinite;
        }

        @keyframes heroFloat {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-12px)
            }
        }

        /* Generic mock card */
        .mock-card {
            background: var(--card);
            border: 1px solid var(--border2);
            border-radius: 18px;
            padding: 22px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            max-width: 380px;
            margin: 0 auto;
        }

        .mock-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 10%;
            right: 10%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--acc), transparent);
        }

        .mock-hdr {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border)
        }

        .mock-ico {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            flex-shrink: 0;
            background: linear-gradient(135deg, var(--acc), var(--acc-d));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-size: .9rem;
        }

        .mock-label {
            font-size: .58rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text3)
        }

        .mock-title {
            font-family: 'Syne', sans-serif;
            font-size: .85rem;
            font-weight: 800;
            color: var(--acc)
        }

        .mock-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px solid var(--surface2);
            font-size: .7rem
        }

        .mock-row .ml {
            color: var(--text3)
        }

        .mock-row .mv {
            font-weight: 600;
            color: var(--text)
        }

        .sbadge {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            padding: 2px 9px;
            border-radius: 20px;
            font-size: .58rem;
            font-weight: 700
        }

        .s-g {
            background: rgba(16, 185, 129, .1);
            color: #10B981;
            border: 1px solid rgba(16, 185, 129, .25)
        }

        .s-a {
            background: rgba(245, 158, 11, .1);
            color: var(--amber);
            border: 1px solid rgba(245, 158, 11, .25)
        }

        .s-r {
            background: rgba(244, 63, 94, .1);
            color: var(--rose);
            border: 1px solid rgba(244, 63, 94, .25)
        }

        .s-b {
            background: rgba(99, 102, 241, .1);
            color: var(--indigo);
            border: 1px solid rgba(99, 102, 241, .25)
        }

        /* ID CARD MOCK */
        .id-card-mock {
            background: linear-gradient(135deg, var(--acc), var(--acc-d));
            border-radius: 16px;
            padding: 20px;
            color: #000;
            box-shadow: 0 12px 36px color-mix(in srgb, var(--acc) 40%, transparent);
            max-width: 280px;
            margin: 0 auto;
        }

        .id-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.1rem;
            color: #fff;
            margin-bottom: 10px;
        }

        .id-school {
            font-size: .6rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: .75;
            margin-bottom: 2px
        }

        .id-name {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 800
        }

        .id-row {
            font-size: .68rem;
            opacity: .8;
            margin-top: 3px
        }

        .id-barcode {
            margin-top: 12px;
            height: 28px;
            background: repeating-linear-gradient(90deg, rgba(0, 0, 0, .6) 0px, rgba(0, 0, 0, .6) 2px, transparent 2px, transparent 5px);
            border-radius: 4px;
        }

        /* MARKSHEET MOCK */
        .marks-table {
            width: 100%;
            border-collapse: collapse
        }

        .marks-table th {
            font-size: .6rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text3);
            padding: 5px 0;
            border-bottom: 1px solid var(--border);
            text-align: left
        }

        .marks-table td {
            font-size: .7rem;
            padding: 6px 0;
            border-bottom: 1px solid var(--surface2);
            color: var(--text2)
        }

        .marks-table td:last-child {
            font-weight: 700;
            color: var(--text)
        }

        .grade-pill {
            display: inline-block;
            padding: 1px 7px;
            border-radius: 4px;
            font-size: .6rem;
            font-weight: 700;
        }

        /* FLOAT CHIPS */
        .fc {
            position: absolute;
            border-radius: 12px;
            padding: 10px 14px;
            background: var(--card2);
            border: 1px solid var(--border2);
            box-shadow: var(--shadow);
            font-size: .68rem;
            z-index: 3;
        }

        .fc-num {
            font-family: 'Syne', sans-serif;
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--acc)
        }

        .fc-desc {
            color: var(--text3);
            font-size: .62rem
        }

        .fc-a {
            top: -16px;
            right: -20px;
            animation: fcFloatA 3.5s ease-in-out infinite
        }

        .fc-b {
            bottom: 10px;
            left: -24px;
            animation: fcFloatB 4s ease-in-out infinite
        }

        @keyframes fcFloatA {

            0%,
            100% {
                transform: translate(0, 0) rotate(-2deg)
            }

            50% {
                transform: translate(-8px, -8px) rotate(2deg)
            }
        }

        @keyframes fcFloatB {

            0%,
            100% {
                transform: translate(0, 0) rotate(1deg)
            }

            50% {
                transform: translate(8px, -6px) rotate(-1deg)
            }
        }

        @media(max-width:575px) {

            .fc-a,
            .fc-b {
                display: none
            }
        }

        /* PROGRESS BAR */
        .prog-bar-wrap {
            margin: 6px 0
        }

        .prog-label {
            display: flex;
            justify-content: space-between;
            font-size: .65rem;
            margin-bottom: 3px;
            color: var(--text2)
        }

        .prog-track {
            height: 5px;
            background: var(--surface2);
            border-radius: 3px;
            overflow: hidden
        }

        .prog-fill {
            height: 100%;
            border-radius: 3px;
            background: linear-gradient(90deg, var(--acc), var(--acc-l))
        }

        /* HERO CAROUSEL CONTROLS */
        .hero-controls {
            position: relative;
            z-index: 5;
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 32px;
            flex-wrap: wrap;
        }

        .hc-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--border2);
            cursor: pointer;
            transition: .3s;
            border: none;
            padding: 0;
        }

        .hc-dot.on {
            background: var(--acc);
            width: 24px;
            border-radius: 4px
        }

        .hc-arrow {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--surface2);
            border: 1px solid var(--border2);
            color: var(--text2);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            transition: .25s;
        }

        .hc-arrow:hover {
            background: var(--acc);
            color: #000;
            border-color: var(--acc)
        }

        .slide-counter {
            font-size: .75rem;
            color: var(--text3);
            font-weight: 600
        }

        /* Progress bar under hero */
        .hero-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--border);
            z-index: 5;
        }

        .hero-progress-fill {
            height: 100%;
            background: var(--acc);
            transition: width .1s linear;
            width: 0%;
        }

        /* ═══════════════════════════════════════════
   STATS STRIP
═══════════════════════════════════════════ */
        .stats-strip {
            position: relative;
            z-index: 2;
            background: var(--bg2);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 40px 0;
        }

        .stat-box {
            text-align: center
        }

        .stat-box .sn {
            font-family: 'Syne', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--amber)
        }

        .stat-box .sd {
            font-size: .78rem;
            color: var(--text3);
            margin-top: 3px
        }

        /* ═══════════════════════════════════════════
   SECTIONS COMMON
═══════════════════════════════════════════ */
        section {
            position: relative;
            z-index: 2
        }

        .sec {
            padding: 80px 0
        }

        .sec-sm {
            padding: 60px 0
        }

        .sec-tag {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--amber);
            margin-bottom: 10px;
        }

        .sec-tag::before {
            content: '';
            width: 18px;
            height: 1.5px;
            background: var(--amber)
        }

        .sec-h {
            font-family: 'Syne', sans-serif;
            font-size: clamp(1.7rem, 3.5vw, 2.6rem);
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 12px;
            color: var(--text);
        }

        .sec-sub {
            font-size: .95rem;
            color: var(--text2);
            line-height: 1.8;
            max-width: 540px
        }

        .grad {
            background: linear-gradient(90deg, var(--amber), var(--amber-l), var(--amber));
            background-size: 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            to {
                background-position: 200% center
            }
        }

        /* ═══════════════════════════════════════════
   MODULES / FEATURES GRID
═══════════════════════════════════════════ */
        .mod-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 26px;
            height: 100%;
            transition: all .3s;
            position: relative;
            overflow: hidden;
        }

        .mod-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--acc, var(--amber)), transparent);
            opacity: 0;
            transition: .3s;
        }

        .mod-card:hover {
            transform: translateY(-6px);
            border-color: var(--border2);
            box-shadow: var(--shadow)
        }

        .mod-card:hover::after {
            opacity: 1
        }

        .mod-ico {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: color-mix(in srgb, var(--acc, var(--amber)) 12%, transparent);
            border: 1px solid color-mix(in srgb, var(--acc, var(--amber)) 28%, transparent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--acc, var(--amber));
            margin-bottom: 16px;
        }

        .mod-card h4 {
            font-size: .95rem;
            font-weight: 700;
            margin-bottom: 7px;
            color: var(--text)
        }

        .mod-card p {
            font-size: .82rem;
            color: var(--text2);
            line-height: 1.7
        }

        .mod-n {
            position: absolute;
            top: 16px;
            right: 18px;
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: var(--border);
            line-height: 1
        }

        /* ═══════════════════════════════════════════
   PAIN / SOLUTION
═══════════════════════════════════════════ */
        .pain-it {
            display: flex;
            gap: 12px;
            padding: 16px;
            margin-bottom: 10px;
            border-radius: 12px;
            background: rgba(244, 63, 94, .05);
            border: 1px solid rgba(244, 63, 94, .12)
        }

        .pain-it i {
            color: var(--rose);
            font-size: 1.1rem;
            margin-top: 2px;
            flex-shrink: 0
        }

        .pain-it h5 {
            font-size: .85rem;
            font-weight: 700;
            color: var(--rose);
            margin-bottom: 3px
        }

        .pain-it p {
            font-size: .78rem;
            color: var(--text3);
            margin: 0
        }

        .sol-it {
            display: flex;
            gap: 12px;
            padding: 16px;
            margin-bottom: 10px;
            border-radius: 12px;
            background: rgba(20, 184, 166, .05);
            border: 1px solid rgba(20, 184, 166, .12)
        }

        .sol-it i {
            color: var(--teal);
            font-size: 1.1rem;
            margin-top: 2px;
            flex-shrink: 0
        }

        .sol-it h5 {
            font-size: .85rem;
            font-weight: 700;
            color: var(--teal);
            margin-bottom: 3px
        }

        .sol-it p {
            font-size: .78rem;
            color: var(--text3);
            margin: 0
        }

        /* ═══════════════════════════════════════════
   WORKFLOW
═══════════════════════════════════════════ */
        .step-c {
            text-align: center;
            padding: 24px 16px
        }

        .step-n {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--amber), var(--amber-d));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: 1.2rem;
            font-weight: 800;
            color: #000;
            margin: 0 auto 14px;
            box-shadow: 0 6px 20px rgba(245, 158, 11, .3);
        }

        .step-c h5 {
            font-weight: 700;
            font-size: .92rem;
            margin-bottom: 7px;
            color: var(--text)
        }

        .step-c p {
            font-size: .8rem;
            color: var(--text2);
            line-height: 1.65
        }

        /* ═══════════════════════════════════════════
   PRICING
═══════════════════════════════════════════ */
        .price-c {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 34px 26px;
            text-align: center;
            height: 100%;
            transition: all .35s;
        }

        .price-c:hover {
            transform: translateY(-8px)
        }

        .price-c.best {
            background: linear-gradient(135deg, rgba(245, 158, 11, .1), rgba(245, 158, 11, .03));
            border-color: var(--amber);
            box-shadow: 0 0 50px rgba(245, 158, 11, .1);
            position: relative;
        }

        .pop-tag {
            position: absolute;
            top: -13px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--amber), var(--amber-d));
            color: #000;
            padding: 3px 16px;
            border-radius: 20px;
            font-size: .6rem;
            font-weight: 800;
            letter-spacing: 2px;
            white-space: nowrap;
        }

        .price-c .pn {
            font-size: .68rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--amber);
            font-weight: 700;
            margin-bottom: 8px
        }

        .price-c .pv {
            font-family: 'Syne', sans-serif;
            font-size: 2.6rem;
            font-weight: 800;
            color: var(--text)
        }

        .price-c .pv span {
            font-size: .85rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text3)
        }

        .p-ul {
            list-style: none;
            text-align: left;
            margin: 18px 0
        }

        .p-ul li {
            font-size: .82rem;
            padding: 6px 0;
            color: var(--text2);
            border-bottom: 1px solid var(--border)
        }

        .p-ul li i {
            color: var(--amber);
            margin-right: 8px;
            width: 12px
        }

        .p-ul li.dis {
            opacity: .3
        }

        .p-ul li.dis i {
            color: var(--text3)
        }

        .btn-p {
            display: block;
            width: 100%;
            padding: 12px;
            border-radius: 50px;
            font-weight: 700;
            font-size: .86rem;
            cursor: pointer;
            transition: .25s;
            text-decoration: none;
            border: none;
        }

        .btn-p-g {
            background: linear-gradient(135deg, var(--amber), var(--amber-d));
            color: #000
        }

        .btn-p-g:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(245, 158, 11, .4);
            color: #000
        }

        .btn-p-o {
            background: transparent;
            color: var(--text);
            border: 1.5px solid var(--border2) !important
        }

        .btn-p-o:hover {
            border-color: var(--amber) !important;
            color: var(--amber)
        }

        /* ═══════════════════════════════════════════
   TESTIMONIALS
═══════════════════════════════════════════ */
        .testi-car {
            overflow: hidden
        }

        .testi-tr {
            display: flex;
            transition: transform .55s cubic-bezier(.4, 0, .2, 1)
        }

        .testi-sl {
            flex: 0 0 calc(33.333% - 14px);
            margin: 0 7px
        }

        @media(max-width:991px) {
            .testi-sl {
                flex: 0 0 calc(50% - 14px)
            }
        }

        @media(max-width:575px) {
            .testi-sl {
                flex: 0 0 calc(100% - 14px)
            }
        }

        .tc {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 24px;
            height: 100%;
            transition: border-color .25s;
        }

        .tc:hover {
            border-color: var(--border2)
        }

        .tc-stars {
            color: var(--amber);
            font-size: .8rem;
            margin-bottom: 12px
        }

        .tc p {
            font-size: .84rem;
            color: var(--text2);
            line-height: 1.78;
            font-style: italic;
            margin-bottom: 16px
        }

        .tc-ath {
            display: flex;
            align-items: center;
            gap: 10px
        }

        .tc-av {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: .85rem;
            color: #000;
            flex-shrink: 0
        }

        .tc-nm {
            font-weight: 700;
            font-size: .85rem;
            color: var(--text)
        }

        .tc-rl {
            font-size: .7rem;
            color: var(--text3)
        }

        .car-ctrl {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 24px
        }

        .car-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--border2);
            cursor: pointer;
            transition: .25s;
            border: none;
            padding: 0
        }

        .car-dot.on {
            background: var(--amber);
            width: 20px;
            border-radius: 4px
        }

        .car-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--surface2);
            border: 1px solid var(--border2);
            color: var(--text2);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            transition: .25s;
        }

        .car-btn:hover {
            background: var(--amber);
            color: #000;
            border-color: var(--amber)
        }

        /* ═══════════════════════════════════════════
   FAQ
═══════════════════════════════════════════ */
        .faq-i {
            border: 1px solid var(--border);
            border-radius: 11px;
            margin-bottom: 8px;
            overflow: hidden;
            transition: border-color .25s
        }

        .faq-i.open {
            border-color: var(--border2)
        }

        .faq-q {
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            font-size: .88rem;
            color: var(--text);
            background: var(--surface);
            transition: .25s
        }

        .faq-q:hover {
            background: var(--surface2)
        }

        .faq-q i {
            color: var(--amber);
            font-size: .8rem;
            transition: transform .3s
        }

        .faq-i.open .faq-q i {
            transform: rotate(45deg)
        }

        .faq-a {
            max-height: 0;
            overflow: hidden;
            transition: .35s ease;
            font-size: .82rem;
            color: var(--text2);
            line-height: 1.75;
            padding: 0 20px
        }

        .faq-i.open .faq-a {
            max-height: 140px;
            padding: 10px 20px 16px
        }

        /* ═══════════════════════════════════════════
   BANNER CTA
═══════════════════════════════════════════ */
        .banner {
            position: relative;
            overflow: hidden;
            background: var(--bg3);
            padding: 80px 0;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .banner-glow {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(245, 158, 11, .15), transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: bGlow 4s ease-in-out infinite;
        }

        @keyframes bGlow {

            0%,
            100% {
                opacity: .6;
                transform: translate(-50%, -50%) scale(1)
            }

            50% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1.15)
            }
        }

        .banner h2 {
            font-family: 'Syne', sans-serif;
            font-size: clamp(1.8rem, 4vw, 3rem);
            font-weight: 800;
            color: var(--text);
            line-height: 1.12;
            margin-bottom: 12px
        }

        .banner p {
            font-size: .97rem;
            color: var(--text2);
            margin-bottom: 28px;
            max-width: 520px;
            margin-left: auto;
            margin-right: auto
        }

        /* ═══════════════════════════════════════════
   ABOUT PAGE
═══════════════════════════════════════════ */
        .about-pg {
            padding-top: 100px
        }

        .co-card {
            background: var(--card);
            border: 1px solid var(--border2);
            border-radius: 22px;
            padding: 32px;
            text-align: center;
        }

        .co-nm {
            font-family: 'Syne', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--amber)
        }

        .co-nm span {
            color: var(--text)
        }

        .co-tag2 {
            font-size: .78rem;
            color: var(--text3)
        }

        .ab-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 9px;
            margin-top: 18px
        }

        .ab-it {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 11px;
            padding: 13px;
            text-align: center;
            font-size: .75rem;
            color: var(--text2)
        }

        .ab-it i {
            display: block;
            font-size: 1.4rem;
            color: var(--amber);
            margin-bottom: 5px
        }

        .miss {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 13px;
            padding: 18px;
            margin-bottom: 12px
        }

        .miss h5 {
            font-weight: 700;
            color: var(--amber);
            margin-bottom: 5px;
            font-size: .9rem
        }

        .miss p {
            font-size: .82rem;
            color: var(--text2);
            margin: 0;
            line-height: 1.7
        }

        .team-c {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 22px;
            text-align: center;
            transition: .25s
        }

        .team-c:hover {
            border-color: var(--border2);
            transform: translateY(-4px)
        }

        .team-av {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1rem;
            color: #000;
            margin: 0 auto 12px
        }

        .team-c h4 {
            font-size: .88rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 3px
        }

        .team-c p {
            font-size: .75rem;
            color: var(--text3)
        }

        .team-c span {
            font-size: .7rem;
            color: var(--amber)
        }

        /* ═══════════════════════════════════════════
   CONTACT PAGE
═══════════════════════════════════════════ */
        .contact-pg {
            padding-top: 100px
        }

        .cform {
            background: var(--card);
            border: 1px solid var(--border2);
            border-radius: 22px;
            padding: 32px
        }

        .form-label {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
            color: var(--text2);
            margin-bottom: 6px;
            display: block
        }

        .form-control,
        .form-select {
            background: var(--surface2) !important;
            border: 1px solid var(--border2) !important;
            color: var(--text) !important;
            border-radius: 9px !important;
            padding: 10px 14px !important;
            font-size: .85rem !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            transition: .25s !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--amber) !important;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, .12) !important;
            outline: none !important;
            background: rgba(245, 158, 11, .04) !important;
        }

        .form-control::placeholder {
            color: var(--text3) !important
        }

        .form-select option {
            background: var(--bg3);
            color: var(--text)
        }

        .ci-c {
            display: flex;
            gap: 12px;
            padding: 16px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 13px;
            margin-bottom: 10px
        }

        .ci-ico {
            width: 40px;
            height: 40px;
            border-radius: 9px;
            background: rgba(245, 158, 11, .1);
            border: 1px solid var(--border2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--amber);
            font-size: .95rem;
            flex-shrink: 0
        }

        .ci-c h6 {
            font-weight: 700;
            font-size: .82rem;
            color: var(--text);
            margin-bottom: 2px
        }

        .ci-c p {
            font-size: .77rem;
            color: var(--text3);
            margin: 0
        }

        .soc-row {
            display: flex;
            gap: 7px;
            margin-top: 14px
        }

        .soc-a {
            width: 32px;
            height: 32px;
            border-radius: 7px;
            background: var(--surface2);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--amber);
            text-decoration: none;
            font-size: .78rem;
            transition: .25s
        }

        .soc-a:hover {
            background: var(--amber);
            color: #000;
            transform: translateY(-2px)
        }

        /* ═══════════════════════════════════════════
   FOOTER
═══════════════════════════════════════════ */
        footer {
            background: var(--bg2);
            border-top: 1px solid var(--border);
            padding: 50px 0 20px
        }

        .ft-logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--amber);
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 8px
        }

        .ft-logo span {
            color: var(--text)
        }

        .ft-desc {
            font-size: .8rem;
            color: var(--text3);
            line-height: 1.75;
            margin-bottom: 18px
        }

        .ft-h {
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--amber);
            margin-bottom: 12px
        }

        .ft-a {
            display: block;
            font-size: .8rem;
            color: var(--text3);
            text-decoration: none;
            padding: 3px 0;
            transition: .25s
        }

        .ft-a:hover {
            color: var(--amber)
        }

        .ft-bot {
            margin-top: 36px;
            padding-top: 18px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            font-size: .75rem;
            color: var(--text3)
        }

        /* ═══════════════════════════════════════════
   SCROLL REVEAL
═══════════════════════════════════════════ */
        .rv {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .6s ease, transform .6s ease
        }

        .rv.vs {
            opacity: 1;
            transform: translateY(0)
        }

        .rl {
            opacity: 0;
            transform: translateX(-28px);
            transition: opacity .6s ease, transform .6s ease
        }

        .rl.vs {
            opacity: 1;
            transform: translateX(0)
        }

        .rr {
            opacity: 0;
            transform: translateX(28px);
            transition: opacity .6s ease, transform .6s ease
        }

        .rr.vs {
            opacity: 1;
            transform: translateX(0)
        }

        .d1 {
            transition-delay: .08s
        }

        .d2 {
            transition-delay: .16s
        }

        .d3 {
            transition-delay: .24s
        }

        .d4 {
            transition-delay: .32s
        }

        .d5 {
            transition-delay: .4s
        }

        /* ═══════════════════════════════════════════
   PAGE SECTIONS
═══════════════════════════════════════════ */
        .pg {
            display: none
        }

        .pg.on {
            display: block
        }

        #pg-home {
            display: block
        }

        /* ═══════════════════════════════════════════
   TOAST
═══════════════════════════════════════════ */
        .toast-el {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: var(--card);
            border: 1px solid var(--teal);
            color: var(--text);
            padding: 12px 20px;
            border-radius: 13px;
            font-size: .84rem;
            z-index: 9999;
            transform: translateX(140%);
            transition: .35s ease;
            display: flex;
            align-items: center;
            gap: 9px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, .2);
            max-width: calc(100vw - 48px);
        }

        .toast-el.show {
            transform: translateX(0)
        }

        .toast-el i {
            color: var(--teal)
        }

        /* ═══════════════════════════════════════════
   UTILITY
═══════════════════════════════════════════ */
        .bg2 {
            background: var(--bg2)
        }

        .sep {
            height: 1px;
            background: var(--border);
            margin: 0
        }

        /* ═══════════════════════════════════════════
   MOBILE FIXES
═══════════════════════════════════════════ */
        @media(max-width:575px) {
            .hero {
                padding-top: 72px;
                min-height: auto
            }

            .hero-slides {
                min-height: auto
            }

            .hero-slide {
                padding: 24px 0 20px
            }

            .hero-title {
                font-size: 1.8rem
            }

            .hero-desc {
                font-size: .88rem
            }

            .btn-hero-pri,
            .btn-hero-sec {
                font-size: .82rem;
                padding: 11px 20px
            }

            .mock-card {
                padding: 16px
            }

            .sec {
                padding: 56px 0
            }

            .sec-sm {
                padding: 44px 0
            }

            .stats-strip {
                padding: 28px 0
            }

            .stat-box .sn {
                font-size: 1.8rem
            }

            .cform {
                padding: 20px
            }

            .price-c {
                padding: 26px 18px
            }

            .ft-bot {
                flex-direction: column;
                text-align: center
            }

            .hero-controls {
                gap: 10px;
                margin-top: 20px
            }
        }

        @media(max-width:375px) {
            .hero-title {
                font-size: 1.6rem
            }

            .brand {
                font-size: 1.25rem
            }

            .brand-ico {
                width: 30px;
                height: 30px
            }
        }
    </style>
</head>

<body>

    <!-- CURSOR (desktop only) -->
    <div id="cur-d"></div>
    <div id="cur-r"></div>

    <!-- BACKGROUND -->
    <div class="bg-canvas">
        <div class="bg-grid"></div>
        <div class="bg-orb orb1"></div>
        <div class="bg-orb orb2"></div>
        <div class="bg-orb orb3"></div>
    </div>

    <!-- ══════════════ NAVBAR ══════════════ -->
    <nav id="navbar" class="navbar navbar-expand-lg">
        <div class="container">
            <a class="brand" href="#" onclick="showPg('home');return false;">
                <div class="brand-ico"><i class="fas fa-graduation-cap"></i></div>
                Go<span>School</span>
            </a>

            <div class="d-flex align-items-center gap-2 d-lg-none">
                <div class="th-btn" onclick="toggleTheme()" aria-label="Toggle theme">
                    <div class="th-knob"><i class="fas fa-sun" id="thIco1"></i></div>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse justify-content-end align-items-center gap-1" id="navMain">
                <ul class="navbar-nav align-items-lg-center gap-0">
                    <li><a class="nav-link np-active" id="nl-home" href="#" onclick="showPg('home');return false;">Home</a></li>
                    <li><a class="nav-link" href="#modules" onclick="showPg('home')">Modules</a></li>
                    <li><a class="nav-link" href="#pricing" onclick="showPg('home')">Pricing</a></li>
                    <li><a class="nav-link" id="nl-about" href="#" onclick="showPg('about');return false;">About</a></li>
                    <li><a class="nav-link" id="nl-contact" href="#" onclick="showPg('contact');return false;">Contact</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2 ms-lg-3 mt-2 mt-lg-0">
                    <div class="th-btn d-none d-lg-block" onclick="toggleTheme()" aria-label="Toggle theme">
                        <div class="th-knob"><i class="fas fa-sun" id="thIco2"></i></div>
                    </div>
                    <a class="btn-demo nav-link" href="#" onclick="gToast('Demo request sent! Our team will contact you.✓');return false;">
                        <i class="fas fa-rocket me-1"></i>Free Demo
                    </a>
                    <a class="btn-login nav-link" href="{{ route('login') }}"> <i class="fas fa-user me-1"></i> Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ══════════════ HOME PAGE ══════════════ -->
    <div id="pg-home" class="pg on">

        <!-- ── HERO CAROUSEL ── -->
        <section class="hero">
            <div class="hero-slides" id="heroSlides">

                <!-- SLIDE 0 — Student Management -->
                <div class="hero-slide slide-accent-0 active" data-index="0">
                    <div class="container">
                        <div class="row align-items-center g-4 g-lg-5">
                            <div class="col-12 col-lg-6">
                                <div class="announce-pill">
                                    <div class="pill-dot"></div>Module 1 of 5
                                </div>
                                <h1 class="hero-title">Student <span class="accent">Management</span> Made Simple</h1>
                                <p class="hero-desc">Complete student profiles, admission tracking, attendance records and parent communication — all in one unified dashboard.</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="#" class="btn-hero-pri" onclick="gToast('Starting free trial...');return false;"><i class="fas fa-rocket"></i>Start Free Trial</a>
                                    <a href="#modules" class="btn-hero-sec"><i class="fas fa-eye"></i>Explore Modules</a>
                                </div>
                                <div class="hero-badges">
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>1,200+ Student Profiles</div>
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>Auto Attendance</div>
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>Parent Portal</div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="hero-visual">
                                    <div class="fc fc-a slide-accent-0">
                                        <div class="fc-num">1,247</div>
                                        <div class="fc-desc"><i class="fas fa-users me-1"></i>Active Students</div>
                                    </div>
                                    <div class="mock-card slide-accent-0">
                                        <div class="mock-hdr">
                                            <div>
                                                <div class="mock-ico"><i class="fas fa-users"></i></div>
                                                <div style="font-size:.58rem;color:var(--text3);margin-top:4px">Student Management</div>
                                            </div>
                                            <div class="text-end">
                                                <div class="mock-label">System</div>
                                                <div class="mock-title">GoSchool SMS</div>
                                            </div>
                                        </div>
                                        <div class="mock-row"><span class="ml"><i class="fas fa-user me-1"></i>Aryan Sharma</span><span class="mv">Class X–A &nbsp;<span class="sbadge s-g">Active</span></span></div>
                                        <div class="mock-row"><span class="ml"><i class="fas fa-user me-1"></i>Priya Singh</span><span class="mv">Class IX–B &nbsp;<span class="sbadge s-g">Active</span></span></div>
                                        <div class="mock-row"><span class="ml"><i class="fas fa-user me-1"></i>Rohit Kumar</span><span class="mv">Class XI–A &nbsp;<span class="sbadge s-a">Leave</span></span></div>
                                        <div class="mock-row"><span class="ml"><i class="fas fa-user me-1"></i>Anjali Devi</span><span class="mv">Class VIII–C &nbsp;<span class="sbadge s-g">Active</span></span></div>
                                        <div class="mt-3">
                                            <div class="prog-bar-wrap">
                                                <div class="prog-label slide-accent-0"><span><i class="fas fa-calendar-check me-1"></i>Attendance Today</span><span>94%</span></div>
                                                <div class="prog-track">
                                                    <div class="prog-fill" style="width:94%"></div>
                                                </div>
                                            </div>
                                            <div class="prog-bar-wrap">
                                                <div class="prog-label slide-accent-0"><span><i class="fas fa-rupee-sign me-1"></i>Fee Collection</span><span>87%</span></div>
                                                <div class="prog-track">
                                                    <div class="prog-fill" style="width:87%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3 d-flex gap-2 flex-wrap">
                                            <span class="sbadge s-g"><i class="fas fa-file-import me-1"></i>Excel Import</span>
                                            <span class="sbadge s-b"><i class="fab fa-whatsapp me-1"></i>Parent Alerts</span>
                                        </div>
                                    </div>
                                    <div class="fc fc-b slide-accent-0">
                                        <div class="fc-num">98%</div>
                                        <div class="fc-desc"><i class="fas fa-chart-line me-1"></i>Attendance Rate</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 1 — Class Management -->
                <div class="hero-slide slide-accent-1" data-index="1">
                    <div class="container">
                        <div class="row align-items-center g-4 g-lg-5">
                            <div class="col-12 col-lg-6">
                                <div class="announce-pill">
                                    <div class="pill-dot"></div>Module 2 of 5
                                </div>
                                <h1 class="hero-title">Smart <span class="accent">Class Management</span> System</h1>
                                <p class="hero-desc">Organize classes, sections, timetables and teacher assignments. Set academic year calendars and manage subjects effortlessly.</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="#" class="btn-hero-pri" onclick="gToast('Starting free trial...');return false;"><i class="fas fa-rocket"></i>Start Free Trial</a>
                                    <a href="#modules" class="btn-hero-sec"><i class="fas fa-eye"></i>View Features</a>
                                </div>
                                <div class="hero-badges">
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>Auto Timetable</div>
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>Subject Mapping</div>
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>Academic Calendar</div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="hero-visual">
                                    <div class="fc fc-a slide-accent-1">
                                        <div class="fc-num">42</div>
                                        <div class="fc-desc"><i class="fas fa-door-open me-1"></i>Classes Active</div>
                                    </div>
                                    <div class="mock-card slide-accent-1">
                                        <div class="mock-hdr">
                                            <div>
                                                <div class="mock-ico"><i class="fas fa-chalkboard"></i></div>
                                                <div style="font-size:.58rem;color:var(--text3);margin-top:4px">Class Management</div>
                                            </div>
                                            <div class="text-end">
                                                <div class="mock-label">Academic Year</div>
                                                <div class="mock-title">2024–25</div>
                                            </div>
                                        </div>
                                        <div class="mock-row"><span class="ml">Class X – Section A</span><span class="mv">38 Students &nbsp;<span class="sbadge s-g">Full</span></span></div>
                                        <div class="mock-row"><span class="ml">Class X – Section B</span><span class="mv">35 Students &nbsp;<span class="sbadge s-g">Full</span></span></div>
                                        <div class="mock-row"><span class="ml">Class IX – Section A</span><span class="mv">30 Students &nbsp;<span class="sbadge s-a">Open</span></span></div>
                                        <div class="mock-row"><span class="ml">Class VIII – Section C</span><span class="mv">28 Students &nbsp;<span class="sbadge s-a">Open</span></span></div>
                                        <div class="mt-3" style="background:var(--surface2);border-radius:10px;padding:10px">
                                            <div style="font-size:.62rem;color:var(--text3);margin-bottom:7px"><i class="fas fa-clock me-1"></i>Today's Timetable — Class X A</div>
                                            <div class="d-flex gap-1 flex-wrap">
                                                <span class="sbadge s-b" style="font-size:.6rem">8:00 Math</span>
                                                <span class="sbadge s-g" style="font-size:.6rem">9:00 Science</span>
                                                <span class="sbadge s-a" style="font-size:.6rem">10:00 English</span>
                                                <span class="sbadge s-b" style="font-size:.6rem">11:00 Hindi</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fc fc-b slide-accent-1">
                                        <div class="fc-num">12</div>
                                        <div class="fc-desc"><i class="fas fa-book-open me-1"></i>Subjects</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 2 — Student ID Card -->
                <div class="hero-slide slide-accent-2" data-index="2">
                    <div class="container">
                        <div class="row align-items-center g-4 g-lg-5">
                            <div class="col-12 col-lg-6">
                                <div class="announce-pill">
                                    <div class="pill-dot"></div>Module 3 of 5
                                </div>
                                <h1 class="hero-title">Digital <span class="accent">ID Card</span> Generator</h1>
                                <p class="hero-desc">Auto-generate professional student ID cards with photos, barcodes, QR codes and school branding. Print or share digitally in seconds.</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="#" class="btn-hero-pri" onclick="gToast('Starting free trial...');return false;"><i class="fas fa-rocket"></i>Start Free Trial</a>
                                    <a href="#modules" class="btn-hero-sec"><i class="fas fa-id-card"></i>See Sample Card</a>
                                </div>
                                <div class="hero-badges">
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>Custom Templates</div>
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>QR / Barcode</div>
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>Bulk Print PDF</div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="hero-visual">
                                    <div class="fc fc-a slide-accent-2">
                                        <div class="fc-num">1.2K</div>
                                        <div class="fc-desc"><i class="fas fa-id-card me-1"></i>Cards Generated</div>
                                    </div>
                                    <div style="max-width:380px;margin:0 auto;display:flex;gap:14px;align-items:flex-start">
                                        <div class="id-card-mock slide-accent-2" style="flex:1">
                                            <div class="id-school">GoSchool Institute</div>
                                            <div class="id-school" style="font-size:.5rem;opacity:.6;margin-bottom:8px">Ranchi, Jharkhand</div>
                                            <div class="id-avatar"><i class="fas fa-user-graduate"></i></div>
                                            <div class="id-name">Aryan Sharma</div>
                                            <div class="id-row"><i class="fas fa-hashtag me-1"></i>Roll: DPS-24-1847</div>
                                            <div class="id-row"><i class="fas fa-graduation-cap me-1"></i>Class X – Section A</div>
                                            <div class="id-row"><i class="fas fa-calendar me-1"></i>Valid: 2024–25</div>
                                            <div class="id-barcode"></div>
                                        </div>
                                        <div style="flex:1">
                                            <div class="mock-card slide-accent-2" style="padding:14px">
                                                <div style="font-size:.62rem;color:var(--text3);margin-bottom:10px"><i class="fas fa-layer-group me-1"></i>Batch Generate</div>
                                                <div class="mock-row"><span class="ml">Class X–A</span><span class="mv"><span class="sbadge s-g">38 Ready</span></span></div>
                                                <div class="mock-row"><span class="ml">Class X–B</span><span class="mv"><span class="sbadge s-g">35 Ready</span></span></div>
                                                <div class="mock-row"><span class="ml">Class IX–A</span><span class="mv"><span class="sbadge s-a">Pending</span></span></div>
                                                <div class="mt-2 d-flex gap-1 flex-wrap">
                                                    <span class="sbadge s-b" style="font-size:.58rem"><i class="fas fa-print me-1"></i>Bulk PDF</span>
                                                    <span class="sbadge s-g" style="font-size:.58rem"><i class="fab fa-whatsapp me-1"></i>Send</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fc fc-b slide-accent-2">
                                        <div class="fc-num">5 sec</div>
                                        <div class="fc-desc"><i class="fas fa-bolt me-1"></i>Per Card</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 3 — Marksheet Management -->
                <div class="hero-slide slide-accent-3" data-index="3">
                    <div class="container">
                        <div class="row align-items-center g-4 g-lg-5">
                            <div class="col-12 col-lg-6">
                                <div class="announce-pill">
                                    <div class="pill-dot"></div>Module 4 of 5
                                </div>
                                <h1 class="hero-title">Automated <span class="accent">Marksheet</span> Generator</h1>
                                <p class="hero-desc">Enter marks once — generate printed marksheets, grade reports, rank lists and progress cards for all students automatically.</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="#" class="btn-hero-pri" onclick="gToast('Starting free trial...');return false;"><i class="fas fa-rocket"></i>Start Free Trial</a>
                                    <a href="#modules" class="btn-hero-sec"><i class="fas fa-file-alt"></i>View Sample</a>
                                </div>
                                <div class="hero-badges">
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>CBSE / ICSE / State</div>
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>Auto Grade & Rank</div>
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>PDF Marksheets</div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="hero-visual">
                                    <div class="fc fc-a slide-accent-3">
                                        <div class="fc-num">96.2</div>
                                        <div class="fc-desc"><i class="fas fa-medal me-1"></i>Class Avg Score</div>
                                    </div>
                                    <div class="mock-card slide-accent-3">
                                        <div class="mock-hdr">
                                            <div>
                                                <div class="mock-ico"><i class="fas fa-file-alt"></i></div>
                                                <div style="font-size:.58rem;color:var(--text3);margin-top:4px">Marksheet — Term 2</div>
                                            </div>
                                            <div class="text-end">
                                                <div class="mock-label">Student</div>
                                                <div class="mock-title">Aryan Sharma</div>
                                                <div style="font-size:.58rem;color:var(--text3)">Class X–A &nbsp;Roll: 01</div>
                                            </div>
                                        </div>
                                        <table class="marks-table">
                                            <thead>
                                                <tr>
                                                    <th>Subject</th>
                                                    <th>Max</th>
                                                    <th>Obtained</th>
                                                    <th>Grade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Mathematics</td>
                                                    <td>100</td>
                                                    <td>94</td>
                                                    <td><span class="grade-pill" style="background:rgba(16,185,129,.1);color:#10B981">A+</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Science</td>
                                                    <td>100</td>
                                                    <td>88</td>
                                                    <td><span class="grade-pill" style="background:rgba(99,102,241,.1);color:#6366F1">A</span></td>
                                                </tr>
                                                <tr>
                                                    <td>English</td>
                                                    <td>100</td>
                                                    <td>91</td>
                                                    <td><span class="grade-pill" style="background:rgba(16,185,129,.1);color:#10B981">A+</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Hindi</td>
                                                    <td>100</td>
                                                    <td>82</td>
                                                    <td><span class="grade-pill" style="background:rgba(245,158,11,.1);color:#F59E0B">B+</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Social Sci.</td>
                                                    <td>100</td>
                                                    <td>79</td>
                                                    <td><span class="grade-pill" style="background:rgba(245,158,11,.1);color:#F59E0B">B</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-between align-items-center mt-3" style="background:var(--surface2);border-radius:9px;padding:9px 12px">
                                            <div style="font-size:.7rem;color:var(--text3)">Total: <strong style="color:var(--text)">434/500</strong></div>
                                            <div style="font-size:.7rem;color:var(--text3)">Percentage: <strong style="color:var(--rose)">86.8%</strong></div>
                                            <div style="font-size:.7rem;color:var(--text3)">Rank: <strong style="color:var(--text)">3rd</strong></div>
                                        </div>
                                    </div>
                                    <div class="fc fc-b slide-accent-3">
                                        <div class="fc-num">A+</div>
                                        <div class="fc-desc"><i class="fas fa-star me-1"></i>Top Grade</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 4 — Fee Management + Academic Year -->
                <div class="hero-slide slide-accent-4" data-index="4">
                    <div class="container">
                        <div class="row align-items-center g-4 g-lg-5">
                            <div class="col-12 col-lg-6">
                                <div class="announce-pill">
                                    <div class="pill-dot"></div>Module 5 of 5
                                </div>
                                <h1 class="hero-title">Fee Invoice &amp; <span class="accent">Academic Year</span> Control</h1>
                                <p class="hero-desc">Set academic years, manage fee structures per class, auto-generate GST invoices and track collections across entire school sessions.</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="#" class="btn-hero-pri" onclick="gToast('Starting free trial...');return false;"><i class="fas fa-rocket"></i>Start Free Trial</a>
                                    <a href="#pricing" onclick="showPg('home')" class="btn-hero-sec"><i class="fas fa-tags"></i>View Pricing</a>
                                </div>
                                <div class="hero-badges">
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>Academic Year Setup</div>
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>GST Invoices</div>
                                    <div class="h-badge"><i class="fas fa-check-circle"></i>Auto Reminders</div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="hero-visual">
                                    <div class="fc fc-a slide-accent-4">
                                        <div class="fc-num">₹2.4Cr</div>
                                        <div class="fc-desc"><i class="fas fa-rupee-sign me-1"></i>Collected This Month</div>
                                    </div>
                                    <div class="mock-card slide-accent-4">
                                        <div class="mock-hdr">
                                            <div>
                                                <div class="mock-ico"><i class="fas fa-calendar-alt"></i></div>
                                                <div style="font-size:.58rem;color:var(--text3);margin-top:4px">Academic Year 2024–25</div>
                                            </div>
                                            <div class="text-end">
                                                <div class="mock-label">Tax Invoice</div>
                                                <div class="mock-title">#INV-2025-0892</div>
                                                <div class="mt-1"><span class="sbadge s-g"><i class="fas fa-check me-1"></i>Paid</span></div>
                                            </div>
                                        </div>
                                        <div class="mock-row"><span class="ml">Student Name</span><span class="mv">Aryan Sharma</span></div>
                                        <div class="mock-row"><span class="ml">Quarter</span><span class="mv">Q3 (Jan–Mar 2025)</span></div>
                                        <div class="mock-row"><span class="ml">Tuition Fee</span><span class="mv">₹8,500</span></div>
                                        <div class="mock-row"><span class="ml">Transport</span><span class="mv">₹1,200</span></div>
                                        <div class="mock-row"><span class="ml">GST (18%)</span><span class="mv">₹1,746</span></div>
                                        <div style="background:color-mix(in srgb,var(--acc) 10%,transparent);border:1px solid color-mix(in srgb,var(--acc) 25%,transparent);border-radius:10px;padding:12px;margin-top:12px;display:flex;justify-content:space-between;align-items:center">
                                            <div style="font-size:.68rem;color:var(--text3)">Total Amount</div>
                                            <div style="font-family:'Syne',sans-serif;font-size:1.3rem;font-weight:800;color:var(--acc)">₹11,446</div>
                                        </div>
                                        <div class="mt-2 d-flex gap-2 flex-wrap">
                                            <span class="sbadge s-g" style="font-size:.6rem"><i class="fas fa-file-pdf me-1"></i>PDF Ready</span>
                                            <span class="sbadge s-a" style="font-size:.6rem"><i class="fab fa-whatsapp me-1"></i>Sent to Parent</span>
                                        </div>
                                    </div>
                                    <div class="fc fc-b slide-accent-4">
                                        <div class="fc-num">98%</div>
                                        <div class="fc-desc"><i class="fas fa-chart-line me-1"></i>Collection Rate</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /hero-slides -->

            <!-- HERO CONTROLS -->
            <div class="container" style="position:relative;z-index:5;padding-bottom:40px">
                <div class="hero-controls" id="heroCtrl">
                    <button class="hc-arrow" onclick="heroPrev()"><i class="fas fa-chevron-left"></i></button>
                    <div id="heroDots" class="d-flex gap-2"></div>
                    <button class="hc-arrow" onclick="heroNext()"><i class="fas fa-chevron-right"></i></button>
                    <span class="slide-counter" id="slideCtr">1 / 5</span>
                </div>
            </div>

            <div class="hero-progress">
                <div class="hero-progress-fill" id="heroProg"></div>
            </div>
        </section>

        <!-- ── STATS STRIP ── -->
        <div class="stats-strip">
            <div class="container">
                <div class="row g-3 text-center">
                    <div class="col-6 col-md-3 rv d1">
                        <div class="stat-box">
                            <div class="sn" data-t="5000" data-s="+">0</div>
                            <div class="sd"><i class="fas fa-school me-1"></i>Schools Onboarded</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 rv d2">
                        <div class="stat-box">
                            <div class="sn" data-t="12" data-s="L+">0</div>
                            <div class="sd"><i class="fas fa-user-graduate me-1"></i>Students Managed</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 rv d3">
                        <div class="stat-box">
                            <div class="sn" data-t="50" data-s="Cr+">0</div>
                            <div class="sd"><i class="fas fa-rupee-sign me-1"></i>Fees Processed</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 rv d4">
                        <div class="stat-box">
                            <div class="sn" data-t="99" data-s="%">0</div>
                            <div class="sd"><i class="fas fa-server me-1"></i>Uptime Guaranteed</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── MODULES ── -->
        <section id="modules" class="sec">
            <div class="container">
                <div class="text-center mb-4 mb-lg-5 rv">
                    <div class="sec-tag">All Modules</div>
                    <div class="sec-h">One Platform, <span class="grad">Five Powerful</span> Modules</div>
                    <p class="sec-sub mx-auto">Everything your school needs — fully integrated and accessible from a single dashboard</p>
                </div>
                <div class="row g-3 g-md-4">
                    <div class="col-12 col-sm-6 col-lg-4 rv d1">
                        <div class="mod-card" style="--acc:var(--amber)">
                            <div class="mod-n">01</div>
                            <div class="mod-ico"><i class="fas fa-users"></i></div>
                            <h4>Student Management</h4>
                            <p>Complete profiles, admission, attendance, documents and parent communication in one place.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 rv d2">
                        <div class="mod-card" style="--acc:var(--teal)">
                            <div class="mod-n">02</div>
                            <div class="mod-ico" style="color:var(--teal)"><i class="fas fa-chalkboard-teacher"></i></div>
                            <h4>Class Management</h4>
                            <p>Organize classes, sections, timetables, teacher assignments and academic year calendars.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 rv d3">
                        <div class="mod-card" style="--acc:var(--indigo)">
                            <div class="mod-n">03</div>
                            <div class="mod-ico" style="color:var(--indigo)"><i class="fas fa-id-card"></i></div>
                            <h4>ID Card Management</h4>
                            <p>Auto-generate ID cards with photos, QR codes, barcodes. Bulk print or send via WhatsApp.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 rv d1">
                        <div class="mod-card" style="--acc:var(--rose)">
                            <div class="mod-n">04</div>
                            <div class="mod-ico" style="color:var(--rose)"><i class="fas fa-file-alt"></i></div>
                            <h4>Marksheet Management</h4>
                            <p>Enter marks once, auto-generate marksheets, grade cards, rank lists and progress reports.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 rv d2">
                        <div class="mod-card" style="--acc:var(--green)">
                            <div class="mod-n">05</div>
                            <div class="mod-ico" style="color:var(--green)"><i class="fas fa-file-invoice"></i></div>
                            <h4>Fee Invoice System</h4>
                            <p>GST invoices, fee collection tracking, auto-reminders and payment gateway integration.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 rv d3">
                        <div class="mod-card" style="--acc:var(--amber)">
                            <div class="mod-n">06</div>
                            <div class="mod-ico"><i class="fas fa-calendar-alt"></i></div>
                            <h4>Academic Year Setup</h4>
                            <p>Configure academic sessions, set fee schedules by quarter/term and manage year-end rollover.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ── PAIN / SOLUTION ── -->
        <section class="sec bg2">
            <div class="container">
                <div class="row g-4 g-lg-5">
                    <div class="col-12 col-lg-6 rl">
                        <div class="sec-tag"><i class="fas fa-times me-1"></i>Before GoSchool</div>
                        <div class="sec-h">Manual Processes <span style="color:var(--rose)">Killing</span> Efficiency</div>
                        <div class="mt-3">
                            <div class="pain-it"><i class="fas fa-book"></i>
                                <div>
                                    <h5>Paper Fee Registers</h5>
                                    <p>Hours wasted maintaining ledgers with no search or reporting</p>
                                </div>
                            </div>
                            <div class="pain-it"><i class="fas fa-id-badge"></i>
                                <div>
                                    <h5>Manual ID Card Printing</h5>
                                    <p>Days to manually type and print ID cards for 1,000+ students</p>
                                </div>
                            </div>
                            <div class="pain-it"><i class="fas fa-file-pen"></i>
                                <div>
                                    <h5>Handwritten Marksheets</h5>
                                    <p>Staff spending weeks calculating grades and typing results</p>
                                </div>
                            </div>
                            <div class="pain-it"><i class="fas fa-exclamation-triangle"></i>
                                <div>
                                    <h5>Data Loss Risk</h5>
                                    <p>Paper records damaged, lost or tampered — audit nightmares</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 rr">
                        <div class="sec-tag"><i class="fas fa-check me-1"></i>After GoSchool</div>
                        <div class="sec-h">Smart. Fast. <span style="color:var(--teal)">Automated.</span></div>
                        <div class="mt-3">
                            <div class="sol-it"><i class="fas fa-bolt"></i>
                                <div>
                                    <h5>Digital Invoice in 1 Click</h5>
                                    <p>Auto-generate branded, GST-compliant fee invoices instantly</p>
                                </div>
                            </div>
                            <div class="sol-it"><i class="fas fa-id-card"></i>
                                <div>
                                    <h5>Bulk ID Cards in Minutes</h5>
                                    <p>Generate and print 1,200 ID cards with barcodes in under 10 minutes</p>
                                </div>
                            </div>
                            <div class="sol-it"><i class="fas fa-star"></i>
                                <div>
                                    <h5>Marksheets in Seconds</h5>
                                    <p>Enter marks once — all marksheets, grades and ranks auto-calculated</p>
                                </div>
                            </div>
                            <div class="sol-it"><i class="fas fa-cloud"></i>
                                <div>
                                    <h5>256-bit Encrypted Cloud</h5>
                                    <p>All data encrypted, backed up automatically — zero data loss risk</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ── WORKFLOW ── -->
        <section class="sec">
            <div class="container">
                <div class="text-center mb-4 mb-lg-5 rv">
                    <div class="sec-tag">How It Works</div>
                    <div class="sec-h">Up &amp; Running in <span class="grad">4 Simple Steps</span></div>
                </div>
                <div class="row g-3 g-md-0">
                    <div class="col-6 col-md-3 rv d1">
                        <div class="step-c">
                            <div class="step-n">1</div>
                            <h5>Register School</h5>
                            <p>Create account, add school name, logo and set academic year.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 rv d2">
                        <div class="step-c">
                            <div class="step-n">2</div>
                            <h5>Add Students &amp; Classes</h5>
                            <p>Import via Excel or add individually. Set class-section structure.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 rv d3">
                        <div class="step-c">
                            <div class="step-n">3</div>
                            <h5>Configure Modules</h5>
                            <p>Set fee structures, marksheet templates, ID card design and more.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 rv d4">
                        <div class="step-c">
                            <div class="step-n">4</div>
                            <h5>Go Live &amp; Automate</h5>
                            <p>Invoices, ID cards, marksheets — all automated. You're done!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ── PRICING ── -->
        <section id="pricing" class="sec bg2">
            <div class="container">
                <div class="text-center mb-4 mb-lg-5 rv">
                    <div class="sec-tag">Pricing</div>
                    <div class="sec-h">Simple, Honest <span class="grad">Pricing</span></div>
                    <p class="sec-sub mx-auto">No hidden charges. Annual plans per school. Cancel anytime.</p>
                </div>
                <div class="row g-3 g-md-4 justify-content-center">
                    <div class="col-12 col-sm-10 col-md-6 col-lg-4 rv d1">
                        <div class="price-c">
                            <div class="pn">Starter</div>
                            <div class="pv">₹4,999<span>/yr</span></div>
                            <p style="font-size:.75rem;color:var(--text3);margin:6px 0">Up to 300 students</p>
                            <ul class="p-ul">
                                <li><i class="fas fa-check"></i>Invoice Generation</li>
                                <li><i class="fas fa-check"></i>Student Profiles</li>
                                <li><i class="fas fa-check"></i>Class Management</li>
                                <li><i class="fas fa-check"></i>Basic Reports</li>
                                <li class="dis"><i class="fas fa-times"></i>ID Card Generator</li>
                                <li class="dis"><i class="fas fa-times"></i>Marksheet System</li>
                                <li class="dis"><i class="fas fa-times"></i>WhatsApp Alerts</li>
                            </ul>
                            <a href="#" class="btn-p btn-p-o" onclick="gToast('Redirecting to checkout...');return false;">Get Started</a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-10 col-md-6 col-lg-4 rv d2">
                        <div class="price-c best">
                            <div class="pop-tag"><i class="fas fa-star me-1"></i>Most Popular</div>
                            <div class="pn">Professional</div>
                            <div class="pv">₹11,999<span>/yr</span></div>
                            <p style="font-size:.75rem;color:var(--text3);margin:6px 0">Up to 1,000 students</p>
                            <ul class="p-ul">
                                <li><i class="fas fa-check"></i>All 5 Modules</li>
                                <li><i class="fas fa-check"></i>ID Card Generator</li>
                                <li><i class="fas fa-check"></i>Marksheet System</li>
                                <li><i class="fas fa-check"></i>WhatsApp Alerts</li>
                                <li><i class="fas fa-check"></i>Payment Gateway</li>
                                <li><i class="fas fa-check"></i>Academic Year Setup</li>
                                <li><i class="fas fa-check"></i>Priority Support</li>
                            </ul>
                            <a href="#" class="btn-p btn-p-g" onclick="gToast('Starting your Pro trial...');return false;">Start Free Trial</a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-10 col-md-6 col-lg-4 rv d3">
                        <div class="price-c">
                            <div class="pn">Enterprise</div>
                            <div class="pv">Custom</div>
                            <p style="font-size:.75rem;color:var(--text3);margin:6px 0">Unlimited students</p>
                            <ul class="p-ul">
                                <li><i class="fas fa-check"></i>Everything in Pro</li>
                                <li><i class="fas fa-check"></i>Multi-Branch</li>
                                <li><i class="fas fa-check"></i>API Access</li>
                                <li><i class="fas fa-check"></i>Custom Integrations</li>
                                <li><i class="fas fa-check"></i>Dedicated Manager</li>
                                <li><i class="fas fa-check"></i>On-site Training</li>
                                <li><i class="fas fa-check"></i>SLA Guarantee</li>
                            </ul>
                            <a href="#" class="btn-p btn-p-o" onclick="showPg('contact');return false;">Contact Sales</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ── TESTIMONIALS ── -->
        <section class="sec">
            <div class="container">
                <div class="text-center mb-4 mb-lg-5 rv">
                    <div class="sec-tag">Testimonials</div>
                    <div class="sec-h">Loved by <span class="grad">5,000+ Schools</span></div>
                </div>
                <div class="testi-car rv">
                    <div class="testi-tr" id="tesiTr">
                        <div class="testi-sl">
                            <div class="tc">
                                <div class="tc-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <p>"Fee defaulters dropped by 68% in one term. WhatsApp invoices are a hit with parents and staff saves 3 hours daily."</p>
                                <div class="tc-ath">
                                    <div class="tc-av" style="background:linear-gradient(135deg,#F59E0B,#B45309)">RS</div>
                                    <div>
                                        <div class="tc-nm">Rajesh Sharma</div>
                                        <div class="tc-rl"><i class="fas fa-school me-1"></i>Principal, DPS Ranchi</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testi-sl">
                            <div class="tc">
                                <div class="tc-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <p>"The ID card generator is brilliant. We printed 1,200 cards with barcodes in under 30 minutes. Saved us days of work!"</p>
                                <div class="tc-ath">
                                    <div class="tc-av" style="background:linear-gradient(135deg,#14B8A6,#0D9488)">PK</div>
                                    <div>
                                        <div class="tc-nm">Priya Kumari</div>
                                        <div class="tc-rl"><i class="fas fa-user-tie me-1"></i>Admin, Loyola School</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testi-sl">
                            <div class="tc">
                                <div class="tc-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <p>"Marksheet generation that used to take 3 weeks now takes 2 hours. The auto-rank and grade calculation is perfect."</p>
                                <div class="tc-ath">
                                    <div class="tc-av" style="background:linear-gradient(135deg,#F43F5E,#BE123C)">AM</div>
                                    <div>
                                        <div class="tc-nm">Anita Mishra</div>
                                        <div class="tc-rl"><i class="fas fa-calculator me-1"></i>HOD, St. Xavier's</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testi-sl">
                            <div class="tc">
                                <div class="tc-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                                <p>"Class management and timetable features are exceptional. We manage 42 sections from one screen. Fantastic!"</p>
                                <div class="tc-ath">
                                    <div class="tc-av" style="background:linear-gradient(135deg,#6366F1,#4338CA)">VT</div>
                                    <div>
                                        <div class="tc-nm">Vikram Tiwari</div>
                                        <div class="tc-rl"><i class="fas fa-building me-1"></i>Director, Vidya Mandir</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testi-sl">
                            <div class="tc">
                                <div class="tc-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <p>"Fee collection efficiency went from 72% to 96% in one quarter. The WhatsApp reminders are incredibly effective."</p>
                                <div class="tc-ath">
                                    <div class="tc-av" style="background:linear-gradient(135deg,#10B981,#059669)">SD</div>
                                    <div>
                                        <div class="tc-nm">Sunita Devi</div>
                                        <div class="tc-rl"><i class="fas fa-chalkboard-teacher me-1"></i>Principal, KV School</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testi-sl">
                            <div class="tc">
                                <div class="tc-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                <p>"Multi-branch support is a game changer. We manage 3 campuses from one dashboard. Student data is perfectly synced."</p>
                                <div class="tc-ath">
                                    <div class="tc-av" style="background:linear-gradient(135deg,#F59E0B,#B45309)">NK</div>
                                    <div>
                                        <div class="tc-nm">Nitin Kumar</div>
                                        <div class="tc-rl"><i class="fas fa-network-wired me-1"></i>IT Head, Cambridge School</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="car-ctrl">
                    <button class="car-btn" onclick="tPrev()"><i class="fas fa-chevron-left"></i></button>
                    <div id="tDots" class="d-flex gap-2"></div>
                    <button class="car-btn" onclick="tNext()"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </section>

        <!-- ── FAQ ── -->
        <section class="sec bg2">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="text-center mb-4 rv">
                            <div class="sec-tag">FAQ</div>
                            <div class="sec-h">Common <span class="grad">Questions</span></div>
                        </div>
                        <div class="faq-i rv">
                            <div class="faq-q" onclick="faqToggle(this)"><span>How long does setup take?</span><i class="fas fa-plus"></i></div>
                            <div class="faq-a">Most schools go fully live within 1 business day. Our team guides you through importing student data, configuring all 5 modules and customizing templates at no extra cost.</div>
                        </div>
                        <div class="faq-i rv d1">
                            <div class="faq-q" onclick="faqToggle(this)"><span>Does it support all exam boards (CBSE, ICSE, State)?</span><i class="fas fa-plus"></i></div>
                            <div class="faq-a">Yes! Marksheet templates support CBSE, ICSE, and all State Board grading systems. You can fully customize grade scales, pass marks and report card formats per class.</div>
                        </div>
                        <div class="faq-i rv d2">
                            <div class="faq-q" onclick="faqToggle(this)"><span>Can ID cards have QR codes and photos?</span><i class="fas fa-plus"></i></div>
                            <div class="faq-a">Absolutely. Each ID card can include the student's photo, QR code, barcode, emergency contact and blood group. Multiple design templates are available.</div>
                        </div>
                        <div class="faq-i rv d3">
                            <div class="faq-q" onclick="faqToggle(this)"><span>How does Academic Year management work?</span><i class="fas fa-plus"></i></div>
                            <div class="faq-a">You set the academic year dates (e.g. April 2024 – March 2025), configure quarterly fee schedules, exam terms, and holidays. Year-end rollover promotes students to next class automatically.</div>
                        </div>
                        <div class="faq-i rv d4">
                            <div class="faq-q" onclick="faqToggle(this)"><span>Is parent data secure?</span><i class="fas fa-plus"></i></div>
                            <div class="faq-a">All data is encrypted with 256-bit SSL, stored on Indian servers with automated daily backups. Role-based access ensures only authorized staff can view sensitive records.</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ── BANNER CTA ── -->
        <section class="banner">
            <div class="banner-glow"></div>
            <div class="container text-center" style="position:relative;z-index:2">
                <div class="rv">
                    <div class="sec-tag justify-content-center">Get Started Free</div>
                    <h2>Ready to Digitize Your <span class="grad">Entire School?</span></h2>
                    <p>Student profiles, classes, ID cards, marksheets and fee invoices — all in one place. Setup in one day.</p>
                    <div class="d-flex justify-content-center gap-2 gap-md-3 flex-wrap">
                        <a href="#" class="btn-hero-pri" onclick="gToast('Starting your 30-day free trial!');return false;"><i class="fas fa-rocket"></i>Start Free 30-Day Trial</a>
                        <a href="#" class="btn-hero-sec" onclick="showPg('contact');return false;"><i class="fas fa-phone-alt"></i>Talk to Sales</a>
                    </div>
                    <p style="font-size:.75rem;color:var(--text3);margin-top:14px">No credit card &nbsp;·&nbsp; Cancel anytime &nbsp;·&nbsp; Full support included</p>
                </div>
            </div>
        </section>

    </div><!-- /HOME -->

    <!-- ══════════════ ABOUT PAGE ══════════════ -->
    <div id="pg-about" class="pg">
        <section class="sec about-pg">
            <div class="container">
                <div class="row g-4 g-lg-5 align-items-center">
                    <div class="col-12 col-lg-5 rl">
                        <div class="co-card">
                            <div class="co-nm"><i class="fas fa-graduation-cap me-2"></i>Go<span>School</span></div>
                            <div class="co-tag2"><i class="fas fa-map-marker-alt me-1"></i>by everthings.in — Ranchi, Jharkhand</div>
                            <div class="ab-grid mt-3">
                                <div class="ab-it"><i class="fas fa-school"></i>5,000+ Schools</div>
                                <div class="ab-it"><i class="fas fa-users"></i>12L+ Students</div>
                                <div class="ab-it"><i class="fas fa-rupee-sign"></i>₹50Cr+ Processed</div>
                                <div class="ab-it"><i class="fas fa-map-pin"></i>Pan India</div>
                            </div>
                        </div>
                        <div class="row g-2 mt-2">
                            <div class="col-4">
                                <div style="background:var(--surface);border:1px solid var(--border);border-radius:11px;padding:12px;text-align:center;font-size:.72rem;color:var(--text2)"><i class="fas fa-award d-block mb-1" style="color:var(--amber);font-size:1.3rem"></i>ISO Certified</div>
                            </div>
                            <div class="col-4">
                                <div style="background:var(--surface);border:1px solid var(--border);border-radius:11px;padding:12px;text-align:center;font-size:.72rem;color:var(--text2)"><i class="fas fa-lock d-block mb-1" style="color:var(--teal);font-size:1.3rem"></i>256-bit SSL</div>
                            </div>
                            <div class="col-4">
                                <div style="background:var(--surface);border:1px solid var(--border);border-radius:11px;padding:12px;text-align:center;font-size:.72rem;color:var(--text2)"><i class="fas fa-certificate d-block mb-1" style="color:var(--rose);font-size:1.3rem"></i>GST Verified</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-7 rr">
                        <div class="sec-tag">About Us</div>
                        <div class="sec-h">We Are <span class="grad">everthings.in</span></div>
                        <p style="color:var(--text2);line-height:1.82;margin-bottom:18px">Based in Ranchi, Jharkhand, everthings.in is a technology company on a mission to digitize India's education administration. Our team of engineers and educators deeply understands school management pain points.</p>
                        <p style="color:var(--text2);line-height:1.82;margin-bottom:24px">GoSchool is our flagship product — a complete school management system covering student profiles, class schedules, ID cards, marksheets and fee invoicing in one platform.</p>
                        <div class="miss">
                            <h5><i class="fas fa-bullseye me-2"></i>Mission</h5>
                            <p>Eliminate manual paperwork from every Indian school and return admin time back to education.</p>
                        </div>
                        <div class="miss">
                            <h5><i class="fas fa-eye me-2"></i>Vision</h5>
                            <p>Enterprise-grade school management for every institution — from metro cities to tier-3 towns.</p>
                        </div>
                        <div class="miss">
                            <h5><i class="fas fa-heart me-2"></i>Values</h5>
                            <p>Simplicity, reliability, transparency. We succeed only when schools succeed.</p>
                        </div>
                    </div>
                </div>
                <!-- TEAM -->
                <div class="mt-4 mt-lg-5 pt-2">
                    <div class="text-center mb-4 rv">
                        <div class="sec-tag">Our Team</div>
                        <div class="sec-h">The People Behind <span class="grad">GoSchool</span></div>
                    </div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-6 col-sm-6 col-md-3 rv d1">
                            <div class="team-c">
                                <div class="team-av" style="background:linear-gradient(135deg,#F59E0B,#B45309)">AK</div>
                                <h4>Abhishek Kumar</h4>
                                <p>Founder &amp; CEO</p><span><i class="fas fa-briefcase me-1"></i>10+ yrs EdTech</span>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-3 rv d2">
                            <div class="team-c">
                                <div class="team-av" style="background:linear-gradient(135deg,#14B8A6,#0D9488)">RS</div>
                                <h4>Riya Singh</h4>
                                <p>Chief Technology Officer</p><span><i class="fas fa-code me-1"></i>Full-Stack</span>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-3 rv d3">
                            <div class="team-c">
                                <div class="team-av" style="background:linear-gradient(135deg,#6366F1,#4338CA)">VM</div>
                                <h4>Vikram Mahato</h4>
                                <p>Head of Sales</p><span><i class="fas fa-handshake me-1"></i>School Relations</span>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-3 rv d4">
                            <div class="team-c">
                                <div class="team-av" style="background:linear-gradient(135deg,#F43F5E,#BE123C)">PD</div>
                                <h4>Pooja Devi</h4>
                                <p>Lead UX Designer</p><span><i class="fas fa-palette me-1"></i>Product Design</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ══════════════ CONTACT PAGE ══════════════ -->
    <div id="pg-contact" class="pg">
        <section class="sec contact-pg">
            <div class="container">
                <div class="text-center mb-4 mb-lg-5 rv">
                    <div class="sec-tag">Contact</div>
                    <div class="sec-h">Let's Talk <span class="grad">School Management</span></div>
                    <p class="sec-sub mx-auto">Free demo, pricing query, or any support — we reply within 2 hours</p>
                </div>
                <div class="row g-4 g-lg-5">
                    <div class="col-12 col-lg-4 rl">
                        <div class="ci-c">
                            <div class="ci-ico"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <h6>Office</h6>
                                <p>Harmu Housing Colony, Ranchi, Jharkhand – 834002</p>
                            </div>
                        </div>
                        <div class="ci-c">
                            <div class="ci-ico"><i class="fas fa-phone-alt"></i></div>
                            <div>
                                <h6>Phone / WhatsApp</h6>
                                <p>+91 98765 43210<br>+91 87654 32109</p>
                            </div>
                        </div>
                        <div class="ci-c">
                            <div class="ci-ico"><i class="fas fa-envelope"></i></div>
                            <div>
                                <h6>Email</h6>
                                <p>hello@everthings.in<br>support@goschool.in</p>
                            </div>
                        </div>
                        <div class="ci-c">
                            <div class="ci-ico"><i class="fas fa-clock"></i></div>
                            <div>
                                <h6>Hours</h6>
                                <p>Mon–Sat: 9AM–7PM<br>Sun: 10AM–4PM</p>
                            </div>
                        </div>
                        <div class="soc-row">
                            <a href="#" class="soc-a"><i class="fab fa-whatsapp"></i></a>
                            <a href="#" class="soc-a"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="soc-a"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="soc-a"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="soc-a"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 rr">
                        <div class="cform">
                            <h4 style="font-family:'Syne',sans-serif;margin-bottom:4px;color:var(--text)"><i class="fas fa-paper-plane me-2" style="color:var(--amber)"></i>Send a Message</h4>
                            <p style="font-size:.78rem;color:var(--text3);margin-bottom:22px">We reply within 2 business hours</p>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6"><label class="form-label">School Name *</label><input type="text" class="form-control" placeholder="e.g. Delhi Public School"></div>
                                <div class="col-12 col-sm-6"><label class="form-label">Your Name *</label><input type="text" class="form-control" placeholder="Principal / Admin Name"></div>
                                <div class="col-12 col-sm-6"><label class="form-label">Phone *</label><input type="tel" class="form-control" placeholder="+91 XXXXX XXXXX"></div>
                                <div class="col-12 col-sm-6"><label class="form-label">Email</label><input type="email" class="form-control" placeholder="you@school.edu.in"></div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Students Count</label>
                                    <select class="form-select">
                                        <option>Select range</option>
                                        <option>Under 200</option>
                                        <option>200–500</option>
                                        <option>500–1,000</option>
                                        <option>1,000–3,000</option>
                                        <option>3,000+</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="form-label">Modules Interested In</label>
                                    <select class="form-select">
                                        <option>Select module</option>
                                        <option>Student Management</option>
                                        <option>Class Management</option>
                                        <option>ID Card System</option>
                                        <option>Marksheet System</option>
                                        <option>Fee Invoice System</option>
                                        <option>All Modules</option>
                                    </select>
                                </div>
                                <div class="col-12"><label class="form-label">Message</label><textarea class="form-control" rows="3" placeholder="Tell us about your school..."></textarea></div>
                                <div class="col-12">
                                    <button class="btn-hero-pri w-100 justify-content-center" style="border:none;font-family:'Plus Jakarta Sans',sans-serif;cursor:pointer;border-radius:50px;padding:14px 28px" onclick="gToast('Message sent! We\'ll contact you within 2 hours.');showPg('home')">
                                        <i class="fas fa-paper-plane"></i>Send Message &amp; Request Free Demo
                                    </button>
                                    <p style="font-size:.7rem;color:var(--text3);margin-top:10px;text-align:center"><i class="fas fa-lock me-1"></i>Your data is private. We never share it.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ══════════════ FOOTER ══════════════ -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="ft-logo">
                        <div class="brand-ico"><i class="fas fa-graduation-cap"></i></div>Go<span>School</span>
                    </div>
                    <div class="ft-desc">India's complete school management system. Student profiles, classes, ID cards, marksheets and fee invoicing — all in one platform. Built by everthings.in, Jharkhand.</div>
                    <div class="soc-row">
                        <a href="#" class="soc-a"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="soc-a"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="soc-a"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="soc-a"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="ft-h">Modules</div>
                    <a class="ft-a" href="#modules" onclick="showPg('home')">Student Mgmt</a>
                    <a class="ft-a" href="#modules" onclick="showPg('home')">Class Mgmt</a>
                    <a class="ft-a" href="#modules" onclick="showPg('home')">ID Cards</a>
                    <a class="ft-a" href="#modules" onclick="showPg('home')">Marksheets</a>
                    <a class="ft-a" href="#modules" onclick="showPg('home')">Fee Invoices</a>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="ft-h">Company</div>
                    <a class="ft-a" href="#" onclick="showPg('about');return false;">About Us</a>
                    <a class="ft-a" href="#" onclick="showPg('contact');return false;">Contact</a>
                    <a class="ft-a" href="#">Blog</a>
                    <a class="ft-a" href="#">Careers</a>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="ft-h">Support</div>
                    <a class="ft-a" href="#">Help Center</a>
                    <a class="ft-a" href="#">Video Guides</a>
                    <a class="ft-a" href="#">Live Chat</a>
                    <a class="ft-a" href="#">Status</a>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="ft-h">Legal</div>
                    <a class="ft-a" href="#">Privacy Policy</a>
                    <a class="ft-a" href="#">Terms</a>
                    <a class="ft-a" href="#">Refund Policy</a>
                    <a class="ft-a" href="#">GST Info</a>
                </div>
            </div>
            <div class="ft-bot">
                <span>&copy; 2025 everthings.in — GoSchool. All rights reserved.</span>
                <span style="color:var(--amber)"><i class="fas fa-heart me-1"></i>Made in Jharkhand, India</span>
            </div>
        </div>
    </footer>

    <!-- TOAST -->
    <div class="toast-el" id="toastEl"><i class="fas fa-check-circle"></i><span id="toastTxt">Done!</span></div>

    <!-- ══════════════ SCRIPTS ══════════════ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        'use strict';
        /* ─── CURSOR (desktop only, no lag) ─── */
        if (window.matchMedia('(pointer:fine)').matches) {
            const cd = document.getElementById('cur-d');
            const cr = document.getElementById('cur-r');
            cd.style.display = 'block';
            cr.style.display = 'block';
            let rx = 0,
                ry = 0,
                tx = 0,
                ty = 0;
            document.addEventListener('mousemove', e => {
                tx = e.clientX;
                ty = e.clientY;
            });

            function cursorLoop() {
                // direct positioning for dot (instant)
                cd.style.left = tx + 'px';
                cd.style.top = ty + 'px';
                // lerp for ring (smooth trail)
                rx += (tx - rx) * .18;
                ry += (ty - ry) * .18;
                cr.style.left = rx + 'px';
                cr.style.top = ry + 'px';
                requestAnimationFrame(cursorLoop);
            }
            requestAnimationFrame(cursorLoop);
            // Hover states
            document.addEventListener('mouseover', e => {
                const t = e.target.closest('a,button,[onclick],.faq-q,.th-btn,.hc-arrow,.car-btn,.c-btn');
                if (t) {
                    cd.style.width = '6px';
                    cd.style.height = '6px';
                    cr.style.width = '48px';
                    cr.style.height = '48px';
                } else {
                    cd.style.width = '9px';
                    cd.style.height = '9px';
                    cr.style.width = '34px';
                    cr.style.height = '34px';
                }
            });
        }

        /* ─── NAVBAR ─── */
        window.addEventListener('scroll', () => {
            document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 50);
        }, {
            passive: true
        });

        /* ─── THEME ─── */
        function toggleTheme() {
            const h = document.documentElement;
            const dark = h.getAttribute('data-theme') === 'dark';
            h.setAttribute('data-theme', dark ? 'light' : 'dark');
            const ico = dark ? 'fa-sun' : 'fa-moon';
            document.querySelectorAll('#thIco1,#thIco2').forEach(i => i.className = 'fas ' + ico);
        }
        // Set initial icon
        document.querySelectorAll('#thIco1,#thIco2').forEach(i => i.className = 'fas fa-moon');

        /* ─── HERO CAROUSEL ─── */
        const SLIDES = 5;
        let hIdx = 0,
            hTimer = null,
            hStart = 0;
        const INTERVAL = 5000;

        function buildHeroDots() {
            const c = document.getElementById('heroDots');
            c.innerHTML = '';
            for (let i = 0; i < SLIDES; i++) {
                const b = document.createElement('button');
                b.className = 'hc-dot' + (i === 0 ? ' on' : '');
                b.setAttribute('aria-label', 'Slide ' + (i + 1));
                b.onclick = (() => {
                    const n = i;
                    return () => heroGo(n);
                })();
                c.appendChild(b);
            }
        }

        function heroGo(n) {
            const slides = document.querySelectorAll('.hero-slide');
            // Remove exit from old
            slides[hIdx].classList.remove('active');
            slides[hIdx].classList.add('exit');
            setTimeout(() => slides[hIdx].classList.remove('exit'), 700);
            hIdx = ((n % SLIDES) + SLIDES) % SLIDES;
            slides[hIdx].classList.add('active');
            // Update accent color on progress
            document.getElementById('heroProg').style.background = 'var(--acc)';
            // Dots
            document.querySelectorAll('.hc-dot').forEach((d, i) => d.classList.toggle('on', i === hIdx));
            document.getElementById('slideCtr').textContent = (hIdx + 1) + ' / ' + SLIDES;
            // Restart timer
            restartHeroTimer();
        }

        function heroNext() {
            heroGo(hIdx + 1)
        }

        function heroPrev() {
            heroGo(hIdx - 1)
        }

        function restartHeroTimer() {
            if (hTimer) clearInterval(hTimer);
            hStart = Date.now();
            const prog = document.getElementById('heroProg');
            prog.style.transition = 'none';
            prog.style.width = '0%';
            setTimeout(() => {
                prog.style.transition = 'width ' + INTERVAL + 'ms linear';
                prog.style.width = '100%';
            }, 50);
            hTimer = setInterval(() => heroGo(hIdx + 1), INTERVAL);
        }

        buildHeroDots();
        restartHeroTimer();

        // Touch swipe for hero
        let hTouchX = 0;
        document.getElementById('heroSlides').addEventListener('touchstart', e => {
            hTouchX = e.touches[0].clientX;
        }, {
            passive: true
        });
        document.getElementById('heroSlides').addEventListener('touchend', e => {
            const dx = e.changedTouches[0].clientX - hTouchX;
            if (Math.abs(dx) > 50) {
                dx < 0 ? heroNext() : heroPrev();
            }
        }, {
            passive: true
        });

        /* ─── TESTIMONIALS CAROUSEL ─── */
        let tIdx = 0;
        const tSlides = document.querySelectorAll('.testi-sl');
        const tTotal = tSlides.length;

        function tVC() {
            return window.innerWidth < 576 ? 1 : window.innerWidth < 992 ? 2 : 3;
        }

        function buildTDots() {
            const c = document.getElementById('tDots');
            c.innerHTML = '';
            const pages = Math.ceil(tTotal / tVC());
            for (let i = 0; i < pages; i++) {
                const b = document.createElement('button');
                b.className = 'car-dot' + (i === 0 ? ' on' : '');
                b.onclick = (() => {
                    const n = i;
                    return () => tGo(n);
                })();
                c.appendChild(b);
            }
        }

        function tGo(page) {
            tIdx = page;
            const vc = tVC(),
                pages = Math.ceil(tTotal / vc);
            tIdx = ((tIdx % pages) + pages) % pages;
            const pct = tIdx * (100 / vc) * vc;
            document.getElementById('tesiTr').style.transform = 'translateX(-' + pct + '%)';
            document.querySelectorAll('.car-dot').forEach((d, i) => d.classList.toggle('on', i === tIdx));
        }

        function tNext() {
            tGo(tIdx + 1)
        }

        function tPrev() {
            tGo(tIdx - 1)
        }
        window.addEventListener('resize', () => {
            tIdx = 0;
            buildTDots();
            tGo(0);
        }, {
            passive: true
        });
        buildTDots();
        setInterval(tNext, 5500);

        /* ─── FAQ ─── */
        function faqToggle(btn) {
            const item = btn.parentElement;
            const was = item.classList.contains('open');
            document.querySelectorAll('.faq-i').forEach(f => f.classList.remove('open'));
            if (!was) item.classList.add('open');
        }

        /* ─── PAGE NAV ─── */
        function showPg(pg) {
            document.querySelectorAll('.pg').forEach(p => p.classList.remove('on'));
            const el = document.getElementById('pg-' + pg);
            if (el) el.classList.add('on');
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            document.querySelectorAll('.nav-link[id^="nl-"]').forEach(l => l.classList.remove('np-active'));
            const nl = document.getElementById('nl-' + pg);
            if (nl) nl.classList.add('np-active');
            // Re-trigger reveals
            setTimeout(initReveal, 120);
            // Collapse mobile nav
            const bsNav = document.getElementById('navMain');
            if (bsNav.classList.contains('show')) {
                bootstrap.Collapse.getOrCreateInstance(bsNav).hide();
            }
        }

        /* ─── SCROLL REVEAL ─── */
        const rvObs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('vs');
            });
        }, {
            threshold: 0.1
        });

        function initReveal() {
            document.querySelectorAll('.rv,.rl,.rr').forEach(el => {
                el.classList.remove('vs');
                rvObs.observe(el);
            });
        }
        initReveal();

        /* ─── COUNTERS ─── */
        const cntObs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting && !e.target._counted) {
                    e.target._counted = true;
                    const el = e.target.querySelector('[data-t]');
                    if (!el) return;
                    const target = +el.dataset.t,
                        suf = el.dataset.s || '';
                    let v = 0;
                    const step = target / 65;
                    const t = setInterval(() => {
                        v = Math.min(v + step, target);
                        el.textContent = Math.floor(v) + suf;
                        if (v >= target) clearInterval(t);
                    }, 20);
                }
            });
        }, {
            threshold: 0.5
        });
        document.querySelectorAll('.stat-box').forEach(el => cntObs.observe(el));

        /* ─── TOAST ─── */
        function gToast(msg) {
            const el = document.getElementById('toastEl');
            document.getElementById('toastTxt').textContent = msg;
            el.classList.add('show');
            setTimeout(() => el.classList.remove('show'), 3500);
        }

        /* ─── SMOOTH ANCHOR ─── */
        document.addEventListener('click', e => {
            const a = e.target.closest('a[href^="#"]');
            if (!a) return;
            const id = a.getAttribute('href');
            if (!id || id === '#') return;
            const t = document.querySelector(id);
            if (t) {
                e.preventDefault();
                t.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    </script>
</body>

</html>