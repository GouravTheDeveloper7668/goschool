<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinLedger Pro — Accounting & Billing</title>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <style>
        /* ═══════════════════ THEME VARIABLES ═══════════════════ */
        :root {
            --bg-base: #f0f4f9;
            --bg-surface: #ffffff;
            --bg-card: #ffffff;
            --bg-card-hover: #f8fafd;
            --bg-input: #f5f7fa;
            --border: #e2e8f0;
            --border-light: #cbd5e1;
            --accent: #3b82f6;
            --accent-glow: rgba(59, 130, 246, 0.18);
            --accent-2: #10b981;
            --accent-3: #f59e0b;
            --accent-4: #ef4444;
            --accent-5: #8b5cf6;
            --text-primary: #1e293b;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --sidebar-width: 248px;
            --header-height: 62px;
            --radius: 12px;
            --radius-sm: 7px;
            --shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 8px 32px rgba(0, 0, 0, 0.12);
            --transition: 0.2s ease;
            --sidebar-bg: #1e293b;
            --sidebar-text: #94a3b8;
            --sidebar-active: #3b82f6;
            --sidebar-hover: rgba(255, 255, 255, 0.07);
            --sidebar-label: #475569;
        }

        [data-theme="dark"] {
            --bg-base: #0a0d14;
            --bg-surface: #111520;
            --bg-card: #161b2e;
            --bg-card-hover: #1c2238;
            --bg-input: #0e1220;
            --border: #1e2a45;
            --border-light: #243050;
            --text-primary: #e8edf8;
            --text-secondary: #8896b3;
            --text-muted: #4a5578;
            --shadow: 0 4px 24px rgba(0, 0, 0, 0.4);
            --shadow-md: 0 8px 40px rgba(0, 0, 0, 0.5);
            --sidebar-bg: #0d1117;
            --sidebar-text: #6b7a9e;
            --sidebar-hover: rgba(255, 255, 255, 0.05);
            --sidebar-label: #3a4a6b;
        }

        /* ═══════════════════ RESET ═══════════════════ */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        html {
            font-size: 14px
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-base);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
            transition: background 0.3s, color 0.3s
        }

        button {
            cursor: pointer;
            border: none;
            background: none;
            font-family: inherit
        }

        input,
        select,
        textarea {
            font-family: inherit
        }

        a {
            text-decoration: none;
            color: inherit
        }

        ul {
            list-style: none
        }

        table {
            border-collapse: collapse;
            width: 100%
        }

        /* ═══════════════════ LOADER ═══════════════════ */
        #page-loader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: var(--bg-surface);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 20px;
            transition: opacity 0.5s ease;
        }

        #page-loader.hide {
            opacity: 0;
            pointer-events: none;
        }

        .loader-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 22px;
            color: var(--text-primary);
        }

        .loader-logo .logo-mark {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.35);
        }

        .loader-logo span {
            color: #3b82f6;
        }

        .loader-bar {
            width: 220px;
            height: 3px;
            background: var(--border);
            border-radius: 99px;
            overflow: hidden;
        }

        .loader-bar-fill {
            height: 100%;
            width: 0;
            border-radius: 99px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            animation: loadBar 1.8s ease-in-out forwards;
        }

        @keyframes loadBar {
            0% {
                width: 0
            }

            60% {
                width: 75%
            }

            100% {
                width: 100%
            }
        }

        .loader-text {
            font-size: 12px;
            color: var(--text-muted);
            letter-spacing: 0.05em;
        }

        /* ═══════════════════ SCROLLBAR ═══════════════════ */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px
        }

        ::-webkit-scrollbar-track {
            background: transparent
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-light);
            border-radius: 99px
        }

        /* ═══════════════════ LAYOUT ═══════════════════ */
        #app {
            display: flex;
            height: 100vh;
            overflow: hidden
        }

        /* ═══════════════════ SIDEBAR ═══════════════════ */
        #sidebar {
            width: var(--sidebar-width);
            min-width: var(--sidebar-width);
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: width 0.25s ease, min-width 0.25s ease;
            z-index: 100;
            position: relative;
            box-shadow: 2px 0 16px rgba(0, 0, 0, 0.08);
        }

        #sidebar.collapsed {
            width: 64px;
            min-width: 64px;
        }

        .sidebar-logo {
            padding: 0 18px;
            height: var(--header-height);
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            overflow: hidden;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .logo-icon-wrap {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 15px;
            box-shadow: 0 4px 14px rgba(59, 130, 246, 0.4);
        }

        .logo-text-wrap {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 15px;
            color: #f1f5f9;
            white-space: nowrap;
            transition: opacity 0.2s, width 0.25s;
        }

        .logo-text-wrap span {
            color: #3b82f6;
        }

        #sidebar.collapsed .logo-text-wrap {
            opacity: 0;
            width: 0;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 10px 10px;
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.12em;
            color: var(--sidebar-label);
            text-transform: uppercase;
            padding: 10px 8px 4px;
            white-space: nowrap;
            overflow: hidden;
            transition: opacity 0.2s;
        }

        #sidebar.collapsed .nav-section-label {
            opacity: 0;
            height: 0;
            padding: 0;
            overflow: hidden;
        }

        /* Nav items */
        .nav-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 9px 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.18s ease;
            white-space: nowrap;
            overflow: hidden;
            position: relative;
            margin-bottom: 1px;
            color: var(--sidebar-text);
        }

        .nav-item:hover {
            background: var(--sidebar-hover);
            color: #e2e8f0;
        }

        .nav-item.active {
            background: rgba(59, 130, 246, 0.15);
            color: #3b82f6;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            bottom: 20%;
            width: 3px;
            background: #3b82f6;
            border-radius: 0 3px 3px 0;
        }

        .nav-item-left {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .nav-icon {
            font-size: 14px;
            width: 18px;
            text-align: center;
            flex-shrink: 0;
            transition: transform 0.2s;
        }

        .nav-item:hover .nav-icon {
            transform: scale(1.1);
        }

        .nav-label {
            font-size: 13px;
            font-weight: 500;
            transition: opacity 0.2s, width 0.25s;
            overflow: hidden;
            white-space: nowrap;
        }

        #sidebar.collapsed .nav-label {
            opacity: 0;
            width: 0;
        }

        .nav-arrow {
            font-size: 10px;
            transition: transform 0.2s, opacity 0.2s;
            color: var(--sidebar-label);
        }

        #sidebar.collapsed .nav-arrow {
            opacity: 0;
            width: 0;
        }

        .nav-item.submenu-open .nav-arrow {
            transform: rotate(90deg);
        }

        /* Submenu */
        .submenu {
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease;
        }

        .submenu.open {
            max-height: 300px;
        }

        #sidebar.collapsed .submenu {
            display: none;
        }

        .submenu-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 7px 10px 7px 38px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
            color: var(--sidebar-text);
            transition: all 0.15s ease;
            margin-bottom: 1px;
        }

        .submenu-item:hover {
            background: var(--sidebar-hover);
            color: #e2e8f0;
        }

        .submenu-item.active {
            color: #3b82f6;
            background: rgba(59, 130, 246, 0.08);
        }

        .submenu-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: currentColor;
            flex-shrink: 0;
        }

        /* Sidebar footer */
        .sidebar-footer {
            padding: 10px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            flex-shrink: 0;
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 8px;
            cursor: pointer;
            overflow: hidden;
            white-space: nowrap;
            transition: background 0.18s;
        }

        .sidebar-user:hover {
            background: var(--sidebar-hover);
        }

        .sidebar-avatar {
            width: 30px;
            height: 30px;
            flex-shrink: 0;
            border-radius: 8px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 11px;
            color: #fff;
        }

        .sidebar-user-info {
            overflow: hidden;
            transition: opacity 0.2s, width 0.25s;
        }

        #sidebar.collapsed .sidebar-user-info {
            opacity: 0;
            width: 0;
        }

        .sidebar-user-name {
            font-size: 12px;
            font-weight: 600;
            color: #e2e8f0;
        }

        .sidebar-user-role {
            font-size: 10px;
            color: var(--sidebar-label);
        }

        /* ═══════════════════ MAIN WRAPPER ═══════════════════ */
        #main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
        }

        /* ═══════════════════ HEADER ═══════════════════ */
        #header {
            height: var(--header-height);
            background: var(--bg-surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 20px;
            gap: 14px;
            flex-shrink: 0;
            z-index: 50;
            box-shadow: 0 1px 0 var(--border);
        }

        #sidebar-toggle {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--bg-input);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            font-size: 14px;
            transition: all 0.18s;
            flex-shrink: 0;
        }

        #sidebar-toggle:hover {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .header-breadcrumb {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 15px;
            color: var(--text-primary);
        }

        .header-search {
            flex: 1;
            max-width: 300px;
            margin-left: 8px;
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 12px;
            height: 36px;
            transition: border-color 0.18s;
        }

        .header-search:focus-within {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .header-search i {
            color: var(--text-muted);
            font-size: 13px;
        }

        .header-search input {
            flex: 1;
            background: none;
            border: none;
            outline: none;
            color: var(--text-primary);
            font-size: 13px;
        }

        .header-search input::placeholder {
            color: var(--text-muted);
        }

        .header-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .hdr-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--bg-input);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: var(--text-secondary);
            transition: all 0.18s;
            position: relative;
            cursor: pointer;
        }

        .hdr-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-glow);
        }

        .notif-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 7px;
            height: 7px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid var(--bg-surface);
        }

        /* Theme toggle */
        .theme-toggle {
            width: 52px;
            height: 28px;
            background: var(--border);
            border-radius: 99px;
            cursor: pointer;
            position: relative;
            transition: background 0.3s;
            border: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            padding: 0 5px;
            justify-content: space-between;
        }

        [data-theme="dark"] .theme-toggle {
            background: #243050;
            border-color: #2d3f6a;
        }

        .theme-toggle i {
            font-size: 11px;
            z-index: 1;
            transition: color 0.3s;
        }

        .theme-toggle .fa-sun {
            color: var(--accent-3);
        }

        .theme-toggle .fa-moon {
            color: var(--accent-5);
        }

        .toggle-thumb {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="dark"] .toggle-thumb {
            transform: translateX(24px);
            background: #3b82f6;
        }

        /* Company selector */
        .company-sel {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0 12px;
            height: 36px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.18s;
            white-space: nowrap;
        }

        .company-sel:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .co-dot {
            width: 7px;
            height: 7px;
            background: #10b981;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* Profile dropdown */
        .profile-wrap {
            position: relative;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 9px;
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 4px 10px 4px 4px;
            cursor: pointer;
            transition: all 0.18s;
            height: 36px;
        }

        .profile-btn:hover {
            border-color: var(--accent);
            background: var(--accent-glow);
        }

        .profile-avatar {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 11px;
            color: #fff;
        }

        .profile-name {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .profile-chevron {
            font-size: 10px;
            color: var(--text-muted);
            transition: transform 0.2s;
        }

        .profile-wrap.open .profile-chevron {
            transform: rotate(180deg);
        }

        .profile-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: 220px;
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            z-index: 200;
            overflow: hidden;
            display: none;
            animation: dropIn 0.18s ease;
        }

        .profile-wrap.open .profile-dropdown {
            display: block;
        }

        @keyframes dropIn {
            from {
                opacity: 0;
                transform: translateY(-6px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .profile-dd-header {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-dd-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 14px;
            color: #fff;
        }

        .profile-dd-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .profile-dd-email {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .profile-dd-menu {
            padding: 6px;
        }

        .profile-dd-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 7px;
            font-size: 13px;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.15s;
        }

        .profile-dd-item:hover {
            background: var(--bg-card-hover);
            color: var(--text-primary);
        }

        .profile-dd-item i {
            width: 16px;
            text-align: center;
            font-size: 13px;
            color: var(--text-muted);
        }

        .profile-dd-item:hover i {
            color: var(--accent);
        }

        .profile-dd-divider {
            height: 1px;
            background: var(--border);
            margin: 4px 6px;
        }

        .profile-dd-item.danger {
            color: #ef4444;
        }

        .profile-dd-item.danger i {
            color: #ef4444;
        }

        .profile-dd-item.danger:hover {
            background: rgba(239, 68, 68, 0.08);
        }

        /* ═══════════════════ CONTENT ═══════════════════ */
        #content {
            flex: 1;
            overflow-y: auto;
            padding: 22px;
            background: var(--bg-base);
        }

        /* ═══════════════════ PAGES ═══════════════════ */
        .page {
            display: none;
            animation: fadeUp 0.28s ease;
        }

        .page.active {
            display: block;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 22px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .page-title small {
            display: block;
            font-size: 12px;
            font-weight: 400;
            color: var(--text-muted);
            font-family: 'Outfit', sans-serif;
            margin-top: 2px;
        }

        .page-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* ═══════════════════ BUTTONS ═══════════════════ */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.18s;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .btn i {
            font-size: 12px;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 2px 10px var(--accent-glow);
        }

        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px var(--accent-glow);
        }

        .btn-secondary {
            background: var(--bg-card);
            color: var(--text-secondary);
            border-color: var(--border);
        }

        .btn-secondary:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .btn-success {
            background: rgba(16, 185, 129, 0.12);
            color: #10b981;
            border-color: rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            background: rgba(16, 185, 129, 0.22);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        .btn-sm {
            padding: 5px 11px;
            font-size: 12px;
            border-radius: 6px;
        }

        /* ═══════════════════ CARDS ═══════════════════ */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            transition: border-color 0.18s, box-shadow 0.18s;
            box-shadow: var(--shadow);
        }

        .card:hover {
            border-color: var(--border-light);
        }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 12px;
            font-weight: 700;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.09em;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* ═══════════════════ STAT CARDS ═══════════════════ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(195px, 1fr));
            gap: 14px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 18px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: var(--radius) var(--radius) 0 0;
        }

        .stat-card.blue::after {
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
        }

        .stat-card.green::after {
            background: linear-gradient(90deg, #10b981, #34d399);
        }

        .stat-card.orange::after {
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
        }

        .stat-card.red::after {
            background: linear-gradient(90deg, #ef4444, #f87171);
        }

        .stat-card.purple::after {
            background: linear-gradient(90deg, #8b5cf6, #a78bfa);
        }

        .stat-card.teal::after {
            background: linear-gradient(90deg, #06b6d4, #38bdf8);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--border-light);
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }

        .stat-icon.blue {
            background: rgba(59, 130, 246, 0.12);
            color: #3b82f6;
        }

        .stat-icon.green {
            background: rgba(16, 185, 129, 0.12);
            color: #10b981;
        }

        .stat-icon.orange {
            background: rgba(245, 158, 11, 0.12);
            color: #f59e0b;
        }

        .stat-icon.red {
            background: rgba(239, 68, 68, 0.12);
            color: #ef4444;
        }

        .stat-icon.purple {
            background: rgba(139, 92, 246, 0.12);
            color: #8b5cf6;
        }

        .stat-icon.teal {
            background: rgba(6, 182, 212, 0.12);
            color: #06b6d4;
        }

        .stat-value {
            font-family: 'Syne', sans-serif;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--text-primary);
        }

        .stat-change {
            font-size: 11px;
            display: flex;
            align-items: center;
            gap: 4px;
            font-weight: 500;
        }

        .stat-change.up {
            color: #10b981;
        }

        .stat-change.down {
            color: #ef4444;
        }

        /* ═══════════════════ GRID ═══════════════════ */
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .grid-2-1 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 14px;
        }

        .grid-1-2 {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 14px;
        }

        /* ═══════════════════ CHARTS ═══════════════════ */
        .chart-wrapper {
            position: relative;
            height: 220px;
        }

        /* ═══════════════════ TABLES ═══════════════════ */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 8px;
        }

        .data-table thead th {
            padding: 10px 14px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: var(--text-muted);
            background: var(--bg-base);
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        .data-table tbody td {
            padding: 11px 14px;
            font-size: 13px;
            color: var(--text-secondary);
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        .data-table tbody tr:hover td {
            background: var(--bg-card-hover);
            color: var(--text-primary);
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* ═══════════════════ BADGES ═══════════════════ */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 8px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.03em;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.12);
            color: #10b981;
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.12);
            color: #d97706;
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .badge-info {
            background: rgba(59, 130, 246, 0.12);
            color: #3b82f6;
        }

        .badge-purple {
            background: rgba(139, 92, 246, 0.12);
            color: #8b5cf6;
        }

        .badge-muted {
            background: var(--bg-input);
            color: var(--text-muted);
        }

        /* ═══════════════════ FORMS ═══════════════════ */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 14px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group.full {
            grid-column: 1/-1;
        }

        .form-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
        }

        .form-label .req {
            color: #ef4444;
        }

        .form-input,
        .form-select,
        .form-textarea {
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 9px 12px;
            color: var(--text-primary);
            font-size: 13px;
            transition: border-color 0.18s, box-shadow 0.18s;
            outline: none;
            width: 100%;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: var(--text-muted);
        }

        .form-select {
            cursor: pointer;
        }

        .form-select option {
            background: var(--bg-card);
            color: var(--text-primary);
        }

        .form-textarea {
            resize: vertical;
            min-height: 80px;
        }

        /* ═══════════════════ MODALS ═══════════════════ */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(5px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            width: 92%;
            max-width: 640px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalIn 0.22s ease;
            box-shadow: var(--shadow-md);
        }

        .modal-lg {
            max-width: 920px;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: scale(0.96) translateY(-16px)
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0)
            }
        }

        .modal-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            background: var(--bg-surface);
            z-index: 1;
        }

        .modal-title {
            font-family: 'Syne', sans-serif;
            font-size: 16px;
            font-weight: 700;
        }

        .modal-close {
            width: 30px;
            height: 30px;
            border-radius: 7px;
            background: var(--bg-input);
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            transition: all 0.18s;
        }

        .modal-close:hover {
            background: #ef4444;
            color: #fff;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            position: sticky;
            bottom: 0;
            background: var(--bg-surface);
        }

        /* ═══════════════════ INVOICE PRINT ═══════════════════ */
        .invoice-preview {
            background: #fff;
            color: #1a1a2e;
            padding: 40px;
            border-radius: var(--radius);
            font-family: 'Outfit', sans-serif;
            font-size: 13px;
        }

        .inv-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 28px;
        }

        .inv-company-name {
            font-family: 'Syne', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: #1a1a2e;
        }

        .inv-company-details {
            font-size: 11px;
            color: #666;
            line-height: 1.7;
            margin-top: 4px;
        }

        .inv-badge {
            background: #eff6ff;
            color: #3b82f6;
            padding: 6px 16px;
            border-radius: 99px;
            font-weight: 700;
            font-size: 12px;
            border: 2px solid #3b82f6;
        }

        .inv-number {
            font-size: 22px;
            font-weight: 800;
            color: #3b82f6;
            margin-top: 4px;
        }

        .inv-divider {
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, transparent);
            margin: 14px 0;
        }

        .inv-parties {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 22px;
        }

        .inv-party-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #999;
            margin-bottom: 5px;
        }

        .inv-party-name {
            font-weight: 700;
            font-size: 14px;
            color: #1a1a2e;
        }

        .inv-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .inv-table thead {
            background: #1e293b;
        }

        .inv-table thead th {
            padding: 10px 12px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.05em;
        }

        .inv-table tbody td {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
            font-size: 12px;
        }

        .inv-table tbody tr:nth-child(even) td {
            background: #f8f9ff;
        }

        .inv-totals {
            display: flex;
            justify-content: flex-end;
        }

        .inv-totals-inner {
            min-width: 280px;
        }

        .inv-total-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px solid #eee;
            font-size: 12px;
        }

        .inv-total-final {
            font-size: 15px;
            font-weight: 800;
            color: #3b82f6;
            border-bottom: none !important;
            padding-top: 10px;
        }

        .inv-footer-note {
            margin-top: 22px;
            padding-top: 14px;
            border-top: 1px solid #eee;
            font-size: 11px;
            color: #aaa;
            text-align: center;
        }

        /* ═══════════════════ MISC ═══════════════════ */
        .divider {
            height: 1px;
            background: var(--border);
            margin: 16px 0;
        }

        .empty-state {
            text-align: center;
            padding: 48px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 36px;
            margin-bottom: 12px;
            opacity: 0.4;
        }

        .empty-state p {
            font-size: 13px;
        }

        .mono {
            font-family: 'JetBrains Mono', monospace;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-green {
            color: #10b981;
        }

        .text-red {
            color: #ef4444;
        }

        .text-blue {
            color: #3b82f6;
        }

        .text-orange {
            color: #f59e0b;
        }

        .text-muted {
            color: var(--text-muted);
        }

        .fw-600 {
            font-weight: 600;
        }

        .fw-700 {
            font-weight: 700;
        }

        .tag {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 5px;
            font-size: 11px;
            background: var(--bg-input);
            color: var(--text-secondary);
            border: 1px solid var(--border);
            margin: 2px;
        }

        .search-filter-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }

        .search-filter-bar input,
        .search-filter-bar select {
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 7px 12px;
            color: var(--text-primary);
            font-size: 13px;
            outline: none;
            transition: border-color 0.18s;
        }

        .search-filter-bar input:focus,
        .search-filter-bar select:focus {
            border-color: var(--accent);
        }

        .search-filter-bar input::placeholder {
            color: var(--text-muted);
        }

        .progress-bar-wrap {
            background: var(--bg-input);
            border-radius: 99px;
            height: 5px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            border-radius: 99px;
            transition: width 0.6s ease;
        }

        .report-summary {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(155px, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .report-box {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 14px;
        }

        .report-box-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            margin-bottom: 6px;
            font-weight: 700;
        }

        .report-box-value {
            font-family: 'Syne', sans-serif;
            font-size: 18px;
            font-weight: 800;
            color: var(--text-primary);
        }

        /* Line items table */
        .line-items-table {
            width: 100%;
        }

        .line-items-table th {
            text-align: left;
            padding: 8px 10px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
        }

        .line-items-table td {
            padding: 6px 8px;
            vertical-align: middle;
        }

        .line-items-table td input,
        .line-items-table td select {
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 6px 10px;
            color: var(--text-primary);
            font-size: 12px;
            width: 100%;
            outline: none;
        }

        .line-items-table td input:focus,
        .line-items-table td select:focus {
            border-color: var(--accent);
        }

        .remove-line {
            color: #ef4444;
            font-size: 14px;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 5px;
        }

        .remove-line:hover {
            background: rgba(239, 68, 68, 0.12);
        }

        /* Toast */
        #toast-container {
            position: fixed;
            bottom: 22px;
            right: 22px;
            z-index: 9998;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .toast {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 12px 16px;
            font-size: 13px;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: var(--shadow-md);
            min-width: 260px;
            animation: toastIn 0.22s ease;
        }

        .toast.success {
            border-left: 3px solid #10b981;
        }

        .toast.error {
            border-left: 3px solid #ef4444;
        }

        .toast.info {
            border-left: 3px solid #3b82f6;
        }

        .toast i {
            font-size: 14px;
        }

        .toast.success i {
            color: #10b981;
        }

        .toast.error i {
            color: #ef4444;
        }

        .toast.info i {
            color: #3b82f6;
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateX(16px)
            }

            to {
                opacity: 1;
                transform: translateX(0)
            }
        }

        /* Responsive */
        @media(max-width:900px) {
            :root {
                --sidebar-width: 64px;
            }

            .nav-label,
            .nav-section-label,
            .logo-text-wrap {
                display: none !important;
            }

            .grid-2,
            .grid-2-1,
            .grid-1-2,
            .grid-3 {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width:600px) {
            #content {
                padding: 12px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .header-search,
            .company-sel {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- ═══════════ PAGE LOADER ═══════════ -->
    <div id="page-loader">
        <div class="loader-logo">
            <div class="logo-mark"><i class="fa-solid fa-book-open-cover"></i></div>
            <div>Fin<span>Ledger</span> <span style="font-size:11px;color:var(--text-muted);font-weight:400;display:block;margin-top:-2px">Accounting Suite</span></div>
        </div>
        <div class="loader-bar">
            <div class="loader-bar-fill"></div>
        </div>
        <div class="loader-text">Loading your workspace...</div>
    </div>

    <div id="app" style="opacity:0;transition:opacity 0.4s">

        <!-- ═══════════ SIDEBAR ═══════════ -->
        <aside id="sidebar">
            <div class="sidebar-logo">
                <div class="logo-icon-wrap"><i class="fa-solid fa-book-open-cover"></i></div>
                <div class="logo-text-wrap">Fin<span>Ledger</span></div>
            </div>

            <nav class="sidebar-nav" id="sidebar-nav">
                <!-- MAIN -->
                <div class="nav-section-label">Main</div>
                <div class="nav-item active" data-page="dashboard">
                    <div class="nav-item-left"><i class="fa-solid fa-gauge nav-icon"></i><span class="nav-label">Dashboard</span></div>
                </div>
                <div class="nav-item" data-page="companies">
                    <div class="nav-item-left"><i class="fa-solid fa-building nav-icon"></i><span class="nav-label">Companies</span></div>
                </div>

                <!-- PARTIES -->
                <div class="nav-section-label">Parties</div>
                <div class="nav-item has-sub" data-sub="sub-parties">
                    <div class="nav-item-left"><i class="fa-solid fa-users nav-icon"></i><span class="nav-label">Parties</span></div>
                    <i class="fa-solid fa-chevron-right nav-arrow"></i>
                </div>
                <div class="submenu" id="sub-parties">
                    <div class="submenu-item" data-page="customers"><span class="submenu-dot"></span>Customers</div>
                    <div class="submenu-item" data-page="suppliers"><span class="submenu-dot"></span>Suppliers</div>
                </div>

                <!-- INVENTORY -->
                <div class="nav-section-label">Inventory</div>
                <div class="nav-item has-sub" data-sub="sub-inventory">
                    <div class="nav-item-left"><i class="fa-solid fa-boxes-stacked nav-icon"></i><span class="nav-label">Inventory</span></div>
                    <i class="fa-solid fa-chevron-right nav-arrow"></i>
                </div>
                <div class="submenu" id="sub-inventory">
                    <div class="submenu-item" data-page="products"><span class="submenu-dot"></span>Products</div>
                    <div class="submenu-item" data-page="stock"><span class="submenu-dot"></span>Stock Summary</div>
                </div>

                <!-- TRANSACTIONS -->
                <div class="nav-section-label">Transactions</div>
                <div class="nav-item has-sub" data-sub="sub-sales">
                    <div class="nav-item-left"><i class="fa-solid fa-file-invoice-dollar nav-icon"></i><span class="nav-label">Sales</span></div>
                    <i class="fa-solid fa-chevron-right nav-arrow"></i>
                </div>
                <div class="submenu" id="sub-sales">
                    <div class="submenu-item" data-page="sales"><span class="submenu-dot"></span>Invoices / Billing</div>
                    <div class="submenu-item" data-page="receipts"><span class="submenu-dot"></span>Receipts</div>
                </div>

                <div class="nav-item has-sub" data-sub="sub-purchase">
                    <div class="nav-item-left"><i class="fa-solid fa-cart-shopping nav-icon"></i><span class="nav-label">Purchase</span></div>
                    <i class="fa-solid fa-chevron-right nav-arrow"></i>
                </div>
                <div class="submenu" id="sub-purchase">
                    <div class="submenu-item" data-page="purchases"><span class="submenu-dot"></span>Purchase Orders</div>
                    <div class="submenu-item" data-page="payments"><span class="submenu-dot"></span>Payments</div>
                </div>

                <div class="nav-item" data-page="expenses">
                    <div class="nav-item-left"><i class="fa-solid fa-money-bill-wave nav-icon"></i><span class="nav-label">Expenses</span></div>
                </div>

                <!-- REPORTS -->
                <div class="nav-section-label">Reports</div>
                <div class="nav-item has-sub" data-sub="sub-reports">
                    <div class="nav-item-left"><i class="fa-solid fa-chart-pie nav-icon"></i><span class="nav-label">Reports</span></div>
                    <i class="fa-solid fa-chevron-right nav-arrow"></i>
                </div>
                <div class="submenu" id="sub-reports">
                    <div class="submenu-item" data-page="gst"><span class="submenu-dot"></span>GST / Tax</div>
                    <div class="submenu-item" data-page="reports"><span class="submenu-dot"></span>Accounting Reports</div>
                </div>

                <!-- ADMIN -->
                <div class="nav-section-label">Admin</div>
                <div class="nav-item" data-page="users">
                    <div class="nav-item-left"><i class="fa-solid fa-shield-halved nav-icon"></i><span class="nav-label">User Management</span></div>
                </div>
                <div class="nav-item" data-page="settings">
                    <div class="nav-item-left"><i class="fa-solid fa-gear nav-icon"></i><span class="nav-label">Settings</span></div>
                </div>
            </nav>

            <div class="sidebar-footer">
                <div class="nav-item" style="margin-bottom:6px">
                    <div class="nav-item-left"><i class="fa-solid fa-circle-question nav-icon"></i><span class="nav-label">Help & Docs</span></div>
                </div>
                <div class="sidebar-user">
                    <div class="sidebar-avatar">AK</div>
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-name">Amit Kumar</div>
                        <div class="sidebar-user-role">Administrator</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- ═══════════ MAIN WRAPPER ═══════════ -->
        <div id="main-wrapper">

            <!-- HEADER -->
            <header id="header">
                <button id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
                <div class="header-breadcrumb" id="breadcrumb">Dashboard</div>
                <div class="header-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search transactions, customers...">
                </div>
                <div class="header-actions">
                    <div class="company-sel">
                        <div class="co-dot"></div><span>TechCorp India Pvt Ltd</span><i class="fa-solid fa-chevron-down" style="font-size:10px;margin-left:2px"></i>
                    </div>

                    <div class="theme-toggle" id="theme-toggle" title="Toggle theme">
                        <i class="fa-solid fa-sun"></i>
                        <i class="fa-solid fa-moon"></i>
                        <div class="toggle-thumb"></div>
                    </div>

                    <div class="hdr-btn" title="Notifications">
                        <i class="fa-solid fa-bell"></i>
                        <div class="notif-badge"></div>
                    </div>
                    <div class="hdr-btn" title="Quick Add" onclick="navigate('sales')">
                        <i class="fa-solid fa-plus"></i>
                    </div>

                    <!-- Profile Dropdown -->
                    <div class="profile-wrap" id="profile-wrap">
                        <div class="profile-btn" id="profile-btn">
                            <div class="profile-avatar">AK</div>
                            <span class="profile-name">Amit Kumar</span>
                            <i class="fa-solid fa-chevron-down profile-chevron"></i>
                        </div>
                        <div class="profile-dropdown" id="profile-dropdown">
                            <div class="profile-dd-header">
                                <div class="profile-dd-avatar">AK</div>
                                <div>
                                    <div class="profile-dd-name">Amit Kumar</div>
                                    <div class="profile-dd-email">amit@techcorp.in</div>
                                </div>
                            </div>
                            <div class="profile-dd-menu">
                                <div class="profile-dd-item" onclick="navigate('settings');closeProfileDropdown()">
                                    <i class="fa-solid fa-circle-user"></i> My Profile
                                </div>
                                <div class="profile-dd-item" onclick="navigate('settings');closeProfileDropdown()">
                                    <i class="fa-solid fa-gear"></i> Account Settings
                                </div>
                                <div class="profile-dd-item" onclick="navigate('companies');closeProfileDropdown()">
                                    <i class="fa-solid fa-building"></i> Company Settings
                                </div>
                                <div class="profile-dd-item" onclick="closeProfileDropdown()">
                                    <i class="fa-solid fa-bell"></i> Notifications
                                </div>
                                <div class="profile-dd-divider"></div>
                                <div class="profile-dd-item" onclick="closeProfileDropdown()">
                                    <i class="fa-solid fa-circle-question"></i> Help & Support
                                </div>
                                <div class="profile-dd-item" onclick="closeProfileDropdown()">
                                    <i class="fa-solid fa-keyboard"></i> Keyboard Shortcuts
                                </div>
                                <div class="profile-dd-divider"></div>
                                <div class="profile-dd-item danger" onclick="toast('Logged out','info');closeProfileDropdown()">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Sign Out
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- CONTENT -->
            <main id="content">

                <!-- DASHBOARD -->
                <div class="page active" id="page-dashboard">
                    <div class="page-header">
                        <div class="page-title">Dashboard <small>Financial overview — FY 2024-25</small></div>
                        <div class="page-actions">
                            <button class="btn btn-secondary"><i class="fa-solid fa-download"></i> Export</button>
                            <button class="btn btn-primary" onclick="navigate('sales')"><i class="fa-solid fa-plus"></i> New Invoice</button>
                        </div>
                    </div>
                    <div class="stats-grid" id="dashboard-stats"></div>
                    <div class="grid-2-1" style="margin-bottom:14px">
                        <div class="card">
                            <div class="card-title">Sales Analytics <span class="badge badge-info">Monthly</span></div>
                            <div class="chart-wrapper"><canvas id="salesChart"></canvas></div>
                        </div>
                        <div class="card">
                            <div class="card-title">Expense Breakdown</div>
                            <div class="chart-wrapper"><canvas id="expenseChart"></canvas></div>
                        </div>
                    </div>
                    <div class="grid-2" style="margin-bottom:14px">
                        <div class="card">
                            <div class="card-title">Recent Invoices <a href="#" onclick="navigate('sales')" style="font-size:11px;color:var(--accent);font-weight:500;text-transform:none;letter-spacing:0">View all <i class="fa-solid fa-arrow-right" style="font-size:9px"></i></a></div>
                            <div class="table-wrapper">
                                <table class="data-table" id="recent-invoices-table"></table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-title">Stock Alerts <span class="badge badge-danger" id="alert-count">0</span></div>
                            <div id="stock-alerts-list"></div>
                        </div>
                    </div>
                    <div class="grid-2">
                        <div class="card">
                            <div class="card-title">Monthly Revenue</div>
                            <div class="chart-wrapper"><canvas id="revenueChart"></canvas></div>
                        </div>
                        <div class="card">
                            <div class="card-title">Top Customers</div>
                            <div id="top-customers-list"></div>
                        </div>
                    </div>
                </div>

                <!-- COMPANIES -->
                <div class="page" id="page-companies">
                    <div class="page-header">
                        <div class="page-title">Companies <small>Manage business entities</small></div>
                        <div class="page-actions"><button class="btn btn-primary" onclick="openModal('company-modal')"><i class="fa-solid fa-plus"></i> Add Company</button></div>
                    </div>
                    <div id="companies-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:14px"></div>
                </div>

                <!-- CUSTOMERS -->
                <div class="page" id="page-customers">
                    <div class="page-header">
                        <div class="page-title">Customers <small>Manage customer accounts & ledger</small></div>
                        <div class="page-actions"><button class="btn btn-primary" onclick="openModal('customer-modal')"><i class="fa-solid fa-user-plus"></i> Add Customer</button></div>
                    </div>
                    <div class="card">
                        <div class="search-filter-bar">
                            <input type="text" placeholder="Search customers..." id="customer-search" oninput="renderCustomers()" style="min-width:220px">
                            <select id="customer-filter" onchange="renderCustomers()">
                                <option value="">All Customers</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>GST No</th>
                                        <th>City</th>
                                        <th>Outstanding</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="customers-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- SUPPLIERS -->
                <div class="page" id="page-suppliers">
                    <div class="page-header">
                        <div class="page-title">Suppliers <small>Vendor management</small></div>
                        <div class="page-actions"><button class="btn btn-primary" onclick="openModal('supplier-modal')"><i class="fa-solid fa-plus"></i> Add Supplier</button></div>
                    </div>
                    <div class="card">
                        <div class="search-filter-bar"><input type="text" placeholder="Search suppliers..." id="supplier-search" oninput="renderSuppliers()"></div>
                        <div class="table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>GST No</th>
                                        <th>City</th>
                                        <th>Balance</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="suppliers-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- PRODUCTS -->
                <div class="page" id="page-products">
                    <div class="page-header">
                        <div class="page-title">Products / Inventory <small>Stock management</small></div>
                        <div class="page-actions">
                            <button class="btn btn-secondary"><i class="fa-solid fa-download"></i> Export</button>
                            <button class="btn btn-primary" onclick="openModal('product-modal')"><i class="fa-solid fa-plus"></i> Add Product</button>
                        </div>
                    </div>
                    <div class="stats-grid" id="inventory-stats"></div>
                    <div class="card">
                        <div class="search-filter-bar">
                            <input type="text" placeholder="Search products..." id="product-search" oninput="renderProducts()">
                            <select id="product-category-filter" onchange="renderProducts()">
                                <option value="">All Categories</option>
                            </select>
                        </div>
                        <div class="table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>HSN</th>
                                        <th>Buy ₹</th>
                                        <th>Sell ₹</th>
                                        <th>Stock</th>
                                        <th>Min</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="products-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- STOCK PAGE -->
                <div class="page" id="page-stock">
                    <div class="page-header">
                        <div class="page-title">Stock Summary <small>Current inventory status</small></div>
                    </div>
                    <div class="card">
                        <div class="table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Opening Stock</th>
                                        <th>Purchased</th>
                                        <th>Sold</th>
                                        <th>Current Stock</th>
                                        <th>Value (₹)</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="stock-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- SALES -->
                <div class="page" id="page-sales">
                    <div class="page-header">
                        <div class="page-title">Sales / Billing <small>GST invoices</small></div>
                        <div class="page-actions">
                            <button class="btn btn-secondary"><i class="fa-solid fa-download"></i> Export</button>
                            <button class="btn btn-primary" onclick="openModal('invoice-modal')"><i class="fa-solid fa-file-invoice"></i> Create Invoice</button>
                        </div>
                    </div>
                    <div class="stats-grid" id="sales-stats"></div>
                    <div class="card">
                        <div class="search-filter-bar">
                            <input type="text" placeholder="Search invoices..." id="invoice-search" oninput="renderInvoices()">
                            <select id="invoice-status-filter" onchange="renderInvoices()">
                                <option value="">All Status</option>
                                <option value="paid">Paid</option>
                                <option value="pending">Pending</option>
                                <option value="overdue">Overdue</option>
                            </select>
                        </div>
                        <div class="table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Invoice #</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Items</th>
                                        <th>Subtotal</th>
                                        <th>GST</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="invoices-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- PURCHASES -->
                <div class="page" id="page-purchases">
                    <div class="page-header">
                        <div class="page-title">Purchase Orders <small>Supplier purchases</small></div>
                        <div class="page-actions"><button class="btn btn-primary" onclick="openModal('purchase-modal')"><i class="fa-solid fa-plus"></i> Add Purchase</button></div>
                    </div>
                    <div class="card">
                        <div class="table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>PO #</th>
                                        <th>Date</th>
                                        <th>Supplier</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Rate</th>
                                        <th>GST%</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="purchases-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- PAYMENTS -->
                <div class="page" id="page-payments">
                    <div class="page-header">
                        <div class="page-title">Payments <small>Outgoing payments</small></div>
                        <div class="page-actions"><button class="btn btn-primary" onclick="openModal('payment-modal')"><i class="fa-solid fa-plus"></i> Record Payment</button></div>
                    </div>
                    <div class="card">
                        <div class="table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Party</th>
                                        <th>Type</th>
                                        <th>Mode</th>
                                        <th>Reference</th>
                                        <th>Amount</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody id="payments-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- RECEIPTS -->
                <div class="page" id="page-receipts">
                    <div class="page-header">
                        <div class="page-title">Receipts <small>Customer payment receipts</small></div>
                        <div class="page-actions"><button class="btn btn-primary" onclick="openModal('receipt-modal')"><i class="fa-solid fa-plus"></i> Record Receipt</button></div>
                    </div>
                    <div class="card">
                        <div class="table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Invoice</th>
                                        <th>Mode</th>
                                        <th>Amount</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody id="receipts-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- EXPENSES -->
                <div class="page" id="page-expenses">
                    <div class="page-header">
                        <div class="page-title">Expenses <small>Business expenditures</small></div>
                        <div class="page-actions"><button class="btn btn-primary" onclick="openModal('expense-modal')"><i class="fa-solid fa-plus"></i> Add Expense</button></div>
                    </div>
                    <div class="stats-grid" id="expense-stats"></div>
                    <div class="card">
                        <div class="table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                    </tr>
                                </thead>
                                <tbody id="expenses-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- GST -->
                <div class="page" id="page-gst">
                    <div class="page-header">
                        <div class="page-title">GST / Tax Reports <small>GSTR-1 & tax liability</small></div>
                        <div class="page-actions">
                            <button class="btn btn-secondary"><i class="fa-solid fa-download"></i> GSTR-1</button>
                            <button class="btn btn-primary"><i class="fa-solid fa-download"></i> GSTR-3B</button>
                        </div>
                    </div>
                    <div id="gst-content"></div>
                </div>

                <!-- REPORTS -->
                <div class="page" id="page-reports">
                    <div class="page-header">
                        <div class="page-title">Accounting Reports <small>P&L, Balance Sheet, Trial Balance</small></div>
                        <div class="page-actions"><button class="btn btn-secondary"><i class="fa-solid fa-file-pdf"></i> Export PDF</button></div>
                    </div>
                    <div id="reports-content"></div>
                </div>

                <!-- USERS -->
                <div class="page" id="page-users">
                    <div class="page-header">
                        <div class="page-title">User Management <small>Roles & access control</small></div>
                        <div class="page-actions"><button class="btn btn-primary" onclick="openModal('user-modal')"><i class="fa-solid fa-user-plus"></i> Add User</button></div>
                    </div>
                    <div class="card">
                        <div class="table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Last Login</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="users-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- SETTINGS -->
                <div class="page" id="page-settings">
                    <div class="page-header">
                        <div class="page-title">Settings <small>System configuration</small></div>
                    </div>
                    <div id="settings-content"></div>
                </div>

            </main>
        </div>
    </div>

    <!-- ═══════════════ MODALS ═══════════════ -->

    <!-- Company Modal -->
    <div class="modal-overlay" id="company-modal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title"><i class="fa-solid fa-building" style="color:var(--accent);margin-right:8px"></i>Add Company</div><button class="modal-close" onclick="closeModal('company-modal')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Company Name <span class="req">*</span></label><input class="form-input" id="co-name" placeholder="TechCorp India Pvt Ltd"></div>
                    <div class="form-group"><label class="form-label">GST Number</label><input class="form-input" id="co-gst" placeholder="27AABCU9603R1ZX"></div>
                    <div class="form-group"><label class="form-label">PAN Number</label><input class="form-input" id="co-pan" placeholder="AABCU9603R"></div>
                    <div class="form-group"><label class="form-label">Phone</label><input class="form-input" id="co-phone" placeholder="+91 98765 43210"></div>
                    <div class="form-group"><label class="form-label">Email</label><input class="form-input" id="co-email" placeholder="info@company.com"></div>
                    <div class="form-group"><label class="form-label">Financial Year</label><select class="form-select" id="co-fy">
                            <option>2024-25</option>
                            <option>2023-24</option>
                            <option>2025-26</option>
                        </select></div>
                    <div class="form-group full"><label class="form-label">Address</label><textarea class="form-textarea" id="co-address" placeholder="Full business address..."></textarea></div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" onclick="closeModal('company-modal')">Cancel</button><button class="btn btn-primary" onclick="saveCompany()"><i class="fa-solid fa-check"></i> Save</button></div>
        </div>
    </div>

    <!-- Customer Modal -->
    <div class="modal-overlay" id="customer-modal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title" id="customer-modal-title"><i class="fa-solid fa-user-plus" style="color:var(--accent);margin-right:8px"></i>Add Customer</div><button class="modal-close" onclick="closeModal('customer-modal')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Customer Name <span class="req">*</span></label><input class="form-input" id="cust-name" placeholder="Rajesh Kumar"></div>
                    <div class="form-group"><label class="form-label">Phone <span class="req">*</span></label><input class="form-input" id="cust-phone" placeholder="+91 99999 88888"></div>
                    <div class="form-group"><label class="form-label">Email</label><input class="form-input" id="cust-email" placeholder="customer@email.com"></div>
                    <div class="form-group"><label class="form-label">GST Number</label><input class="form-input" id="cust-gst" placeholder="27AABCU9603R1ZX"></div>
                    <div class="form-group"><label class="form-label">City</label><input class="form-input" id="cust-city" placeholder="Mumbai"></div>
                    <div class="form-group"><label class="form-label">State</label><input class="form-input" id="cust-state" placeholder="Maharashtra"></div>
                    <div class="form-group full"><label class="form-label">Address</label><textarea class="form-textarea" id="cust-address" placeholder="Full address..."></textarea></div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" onclick="closeModal('customer-modal')">Cancel</button><button class="btn btn-primary" onclick="saveCustomer()"><i class="fa-solid fa-check"></i> Save</button></div>
        </div>
    </div>

    <!-- Supplier Modal -->
    <div class="modal-overlay" id="supplier-modal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title"><i class="fa-solid fa-industry" style="color:var(--accent);margin-right:8px"></i>Add Supplier</div><button class="modal-close" onclick="closeModal('supplier-modal')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Supplier Name <span class="req">*</span></label><input class="form-input" id="sup-name" placeholder="Global Traders"></div>
                    <div class="form-group"><label class="form-label">Phone</label><input class="form-input" id="sup-phone" placeholder="+91 99999 88888"></div>
                    <div class="form-group"><label class="form-label">Email</label><input class="form-input" id="sup-email" placeholder="supplier@email.com"></div>
                    <div class="form-group"><label class="form-label">GST Number</label><input class="form-input" id="sup-gst" placeholder="27AABCU9603R1ZX"></div>
                    <div class="form-group"><label class="form-label">City</label><input class="form-input" id="sup-city" placeholder="Delhi"></div>
                    <div class="form-group"><label class="form-label">Payment Terms</label><select class="form-select" id="sup-terms">
                            <option>30 days</option>
                            <option>15 days</option>
                            <option>45 days</option>
                            <option>Immediate</option>
                        </select></div>
                    <div class="form-group full"><label class="form-label">Address</label><textarea class="form-textarea" id="sup-address" placeholder="Full address..."></textarea></div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" onclick="closeModal('supplier-modal')">Cancel</button><button class="btn btn-primary" onclick="saveSupplier()"><i class="fa-solid fa-check"></i> Save</button></div>
        </div>
    </div>

    <!-- Product Modal -->
    <div class="modal-overlay" id="product-modal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title" id="product-modal-title"><i class="fa-solid fa-box" style="color:var(--accent);margin-right:8px"></i>Add Product</div><button class="modal-close" onclick="closeModal('product-modal')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Product Name <span class="req">*</span></label><input class="form-input" id="prod-name" placeholder="Dell Laptop XPS 15"></div>
                    <div class="form-group"><label class="form-label">Category</label><select class="form-select" id="prod-category">
                            <option>Electronics</option>
                            <option>Office Supplies</option>
                            <option>Furniture</option>
                            <option>Software</option>
                            <option>Hardware</option>
                            <option>Other</option>
                        </select></div>
                    <div class="form-group"><label class="form-label">HSN Code</label><input class="form-input" id="prod-hsn" placeholder="84713010"></div>
                    <div class="form-group"><label class="form-label">Unit</label><input class="form-input" id="prod-unit" placeholder="Nos / Kg / Ltrs"></div>
                    <div class="form-group"><label class="form-label">Purchase Price (₹) <span class="req">*</span></label><input class="form-input" id="prod-buy" type="number" placeholder="45000"></div>
                    <div class="form-group"><label class="form-label">Selling Price (₹) <span class="req">*</span></label><input class="form-input" id="prod-sell" type="number" placeholder="55000"></div>
                    <div class="form-group"><label class="form-label">GST Rate (%)</label><select class="form-select" id="prod-gst">
                            <option value="0">0%</option>
                            <option value="5">5%</option>
                            <option value="12">12%</option>
                            <option value="18" selected>18%</option>
                            <option value="28">28%</option>
                        </select></div>
                    <div class="form-group"><label class="form-label">Opening Stock</label><input class="form-input" id="prod-stock" type="number" placeholder="100"></div>
                    <div class="form-group"><label class="form-label">Min Stock Alert</label><input class="form-input" id="prod-min-stock" type="number" placeholder="10"></div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" onclick="closeModal('product-modal')">Cancel</button><button class="btn btn-primary" onclick="saveProduct()"><i class="fa-solid fa-check"></i> Save</button></div>
        </div>
    </div>

    <!-- Invoice Modal -->
    <div class="modal-overlay" id="invoice-modal">
        <div class="modal modal-lg">
            <div class="modal-header">
                <div class="modal-title"><i class="fa-solid fa-file-invoice-dollar" style="color:var(--accent);margin-right:8px"></i>Create Sales Invoice</div><button class="modal-close" onclick="closeModal('invoice-modal')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-grid" style="margin-bottom:16px">
                    <div class="form-group"><label class="form-label">Customer <span class="req">*</span></label><select class="form-select" id="inv-customer"></select></div>
                    <div class="form-group"><label class="form-label">Invoice Date</label><input class="form-input" id="inv-date" type="date"></div>
                    <div class="form-group"><label class="form-label">Due Date</label><input class="form-input" id="inv-due" type="date"></div>
                    <div class="form-group"><label class="form-label">Payment Terms</label><select class="form-select" id="inv-terms">
                            <option>Immediate</option>
                            <option>15 Days</option>
                            <option>30 Days</option>
                            <option>45 Days</option>
                        </select></div>
                </div>
                <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:var(--text-muted);margin-bottom:10px">Line Items</div>
                <div class="table-wrapper" style="margin-bottom:10px">
                    <table class="line-items-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Rate (₹)</th>
                                <th>GST%</th>
                                <th>CGST</th>
                                <th>SGST</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="line-items-tbody"></tbody>
                    </table>
                </div>
                <button class="btn btn-secondary btn-sm" onclick="addLineItem()"><i class="fa-solid fa-plus"></i> Add Line</button>
                <div class="divider"></div>
                <div style="display:flex;justify-content:flex-end">
                    <div style="min-width:280px">
                        <div style="display:flex;justify-content:space-between;padding:6px 0;font-size:13px;border-bottom:1px solid var(--border)"><span style="color:var(--text-muted)">Subtotal</span><span id="inv-subtotal" class="mono">₹0.00</span></div>
                        <div style="display:flex;justify-content:space-between;padding:6px 0;font-size:13px;border-bottom:1px solid var(--border)"><span style="color:var(--text-muted)">Total GST</span><span id="inv-gst-total" class="mono">₹0.00</span></div>
                        <div style="display:flex;justify-content:space-between;padding:12px 0;font-size:17px;font-weight:800;font-family:'Syne',sans-serif"><span>Grand Total</span><span id="inv-grand-total" class="mono text-blue">₹0.00</span></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('invoice-modal')">Cancel</button>
                <button class="btn btn-secondary" onclick="previewInvoice()"><i class="fa-solid fa-eye"></i> Preview</button>
                <button class="btn btn-primary" onclick="saveInvoice()"><i class="fa-solid fa-floppy-disk"></i> Save Invoice</button>
            </div>
        </div>
    </div>

    <!-- Invoice Preview Modal -->
    <div class="modal-overlay" id="invoice-preview-modal">
        <div class="modal modal-lg">
            <div class="modal-header">
                <div class="modal-title"><i class="fa-solid fa-eye" style="color:var(--accent);margin-right:8px"></i>Invoice Preview</div><button class="modal-close" onclick="closeModal('invoice-preview-modal')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div id="invoice-print-area"></div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" onclick="closeModal('invoice-preview-modal')">Close</button><button class="btn btn-primary" onclick="window.print()"><i class="fa-solid fa-print"></i> Print Invoice</button></div>
        </div>
    </div>

    <!-- Purchase Modal -->
    <div class="modal-overlay" id="purchase-modal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title"><i class="fa-solid fa-cart-shopping" style="color:var(--accent);margin-right:8px"></i>Add Purchase Entry</div><button class="modal-close" onclick="closeModal('purchase-modal')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Supplier <span class="req">*</span></label><select class="form-select" id="pur-supplier"></select></div>
                    <div class="form-group"><label class="form-label">Product <span class="req">*</span></label><select class="form-select" id="pur-product" onchange="fillPurchaseRate()"></select></div>
                    <div class="form-group"><label class="form-label">Quantity <span class="req">*</span></label><input class="form-input" id="pur-qty" type="number" placeholder="10" oninput="calcPurchaseTotal()"></div>
                    <div class="form-group"><label class="form-label">Rate (₹) <span class="req">*</span></label><input class="form-input" id="pur-rate" type="number" placeholder="1000" oninput="calcPurchaseTotal()"></div>
                    <div class="form-group"><label class="form-label">GST %</label><select class="form-select" id="pur-gst" onchange="calcPurchaseTotal()">
                            <option value="0">0%</option>
                            <option value="5">5%</option>
                            <option value="12">12%</option>
                            <option value="18" selected>18%</option>
                            <option value="28">28%</option>
                        </select></div>
                    <div class="form-group"><label class="form-label">Total (₹)</label><input class="form-input" id="pur-total" readonly></div>
                    <div class="form-group"><label class="form-label">Date</label><input class="form-input" id="pur-date" type="date"></div>
                    <div class="form-group"><label class="form-label">Bill No</label><input class="form-input" id="pur-bill-no" placeholder="SUP-2024-001"></div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" onclick="closeModal('purchase-modal')">Cancel</button><button class="btn btn-primary" onclick="savePurchase()"><i class="fa-solid fa-check"></i> Save</button></div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal-overlay" id="payment-modal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title"><i class="fa-solid fa-credit-card" style="color:var(--accent);margin-right:8px"></i>Record Payment</div><button class="modal-close" onclick="closeModal('payment-modal')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Party Type</label><select class="form-select" id="pay-type">
                            <option value="supplier">Supplier</option>
                            <option value="customer">Customer</option>
                        </select></div>
                    <div class="form-group"><label class="form-label">Party Name <span class="req">*</span></label><input class="form-input" id="pay-party" placeholder="Party name"></div>
                    <div class="form-group"><label class="form-label">Amount (₹) <span class="req">*</span></label><input class="form-input" id="pay-amount" type="number" placeholder="50000"></div>
                    <div class="form-group"><label class="form-label">Payment Mode</label><select class="form-select" id="pay-mode">
                            <option>Cash</option>
                            <option>Bank Transfer</option>
                            <option>UPI</option>
                            <option>Cheque</option>
                            <option>NEFT</option>
                            <option>RTGS</option>
                        </select></div>
                    <div class="form-group"><label class="form-label">Reference No</label><input class="form-input" id="pay-ref" placeholder="UTR/Cheque No"></div>
                    <div class="form-group"><label class="form-label">Date</label><input class="form-input" id="pay-date" type="date"></div>
                    <div class="form-group full"><label class="form-label">Notes</label><textarea class="form-textarea" id="pay-notes" placeholder="Notes..."></textarea></div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" onclick="closeModal('payment-modal')">Cancel</button><button class="btn btn-primary" onclick="savePayment()"><i class="fa-solid fa-check"></i> Save</button></div>
        </div>
    </div>

    <!-- Receipt Modal -->
    <div class="modal-overlay" id="receipt-modal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title"><i class="fa-solid fa-receipt" style="color:var(--accent);margin-right:8px"></i>Record Receipt</div><button class="modal-close" onclick="closeModal('receipt-modal')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Customer <span class="req">*</span></label><select class="form-select" id="rec-customer"></select></div>
                    <div class="form-group"><label class="form-label">Against Invoice</label><select class="form-select" id="rec-invoice"></select></div>
                    <div class="form-group"><label class="form-label">Amount (₹) <span class="req">*</span></label><input class="form-input" id="rec-amount" type="number" placeholder="50000"></div>
                    <div class="form-group"><label class="form-label">Payment Mode</label><select class="form-select" id="rec-mode">
                            <option>Cash</option>
                            <option>Bank Transfer</option>
                            <option>UPI</option>
                            <option>Cheque</option>
                            <option>NEFT</option>
                        </select></div>
                    <div class="form-group"><label class="form-label">Date</label><input class="form-input" id="rec-date" type="date"></div>
                    <div class="form-group"><label class="form-label">Notes</label><input class="form-input" id="rec-notes" placeholder="Notes"></div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" onclick="closeModal('receipt-modal')">Cancel</button><button class="btn btn-primary" onclick="saveReceipt()"><i class="fa-solid fa-check"></i> Save</button></div>
        </div>
    </div>

    <!-- Expense Modal -->
    <div class="modal-overlay" id="expense-modal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title"><i class="fa-solid fa-money-bill-wave" style="color:var(--accent);margin-right:8px"></i>Add Expense</div><button class="modal-close" onclick="closeModal('expense-modal')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Category <span class="req">*</span></label><select class="form-select" id="exp-category">
                            <option>Rent</option>
                            <option>Salary</option>
                            <option>Utilities</option>
                            <option>Travel</option>
                            <option>Marketing</option>
                            <option>Office Supplies</option>
                            <option>Maintenance</option>
                            <option>Insurance</option>
                            <option>Miscellaneous</option>
                        </select></div>
                    <div class="form-group"><label class="form-label">Amount (₹) <span class="req">*</span></label><input class="form-input" id="exp-amount" type="number" placeholder="5000"></div>
                    <div class="form-group"><label class="form-label">Payment Method</label><select class="form-select" id="exp-method">
                            <option>Cash</option>
                            <option>Bank Transfer</option>
                            <option>UPI</option>
                            <option>Credit Card</option>
                            <option>Cheque</option>
                        </select></div>
                    <div class="form-group"><label class="form-label">Date</label><input class="form-input" id="exp-date" type="date"></div>
                    <div class="form-group full"><label class="form-label">Description</label><textarea class="form-textarea" id="exp-notes" placeholder="Expense description..."></textarea></div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" onclick="closeModal('expense-modal')">Cancel</button><button class="btn btn-primary" onclick="saveExpense()"><i class="fa-solid fa-check"></i> Save</button></div>
        </div>
    </div>

    <!-- User Modal -->
    <div class="modal-overlay" id="user-modal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title"><i class="fa-solid fa-user-plus" style="color:var(--accent);margin-right:8px"></i>Add User</div><button class="modal-close" onclick="closeModal('user-modal')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-group"><label class="form-label">Full Name <span class="req">*</span></label><input class="form-input" id="usr-name" placeholder="Amit Kumar"></div>
                    <div class="form-group"><label class="form-label">Email <span class="req">*</span></label><input class="form-input" id="usr-email" type="email" placeholder="user@company.com"></div>
                    <div class="form-group"><label class="form-label">Role</label><select class="form-select" id="usr-role">
                            <option>Admin</option>
                            <option>Accountant</option>
                            <option>Sales Manager</option>
                            <option>Purchase Manager</option>
                            <option>Viewer</option>
                        </select></div>
                    <div class="form-group"><label class="form-label">Password</label><input class="form-input" id="usr-pass" type="password" placeholder="••••••••"></div>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" onclick="closeModal('user-modal')">Cancel</button><button class="btn btn-primary" onclick="saveUser()"><i class="fa-solid fa-check"></i> Add User</button></div>
        </div>
    </div>

    <div id="toast-container"></div>

    <!-- ═══════════ JAVASCRIPT ═══════════ -->
    <script>
        /* ── DATA STORE ── */
        const DB = {
            get(k) {
                try {
                    return JSON.parse(localStorage.getItem('fl_' + k)) || [];
                } catch {
                    return [];
                }
            },
            set(k, v) {
                localStorage.setItem('fl_' + k, JSON.stringify(v));
            },
            nextId(k) {
                const a = DB.get(k);
                return a.length ? Math.max(...a.map(i => i.id || 0)) + 1 : 1;
            }
        };

        /* ── SEED ── */
        function seedData() {
            if (DB.get('seeded').length) return;
            DB.set('companies', [{
                id: 1,
                name: 'TechCorp India Pvt Ltd',
                gst: '27AABCU9603R1ZX',
                pan: 'AABCU9603R',
                phone: '+91 22 4567 8901',
                email: 'info@techcorp.in',
                address: 'Andheri West, Mumbai 400053',
                fy: '2024-25'
            }, {
                id: 2,
                name: 'StartUp Solutions LLP',
                gst: '07AALFS1919Q1ZA',
                pan: 'AALFS1919Q',
                phone: '+91 11 4567 2345',
                email: 'hello@startupsolutions.in',
                address: 'Connaught Place, New Delhi 110001',
                fy: '2024-25'
            }]);
            DB.set('customers', [{
                id: 1,
                name: 'Rajesh Kumar Enterprises',
                phone: '+91 98765 43210',
                email: 'rajesh@rkenterprises.in',
                gst: '27AAJCS6553P1ZH',
                city: 'Mumbai',
                state: 'Maharashtra',
                address: 'Bandra West, Mumbai',
                outstanding: 45000,
                status: 'active'
            }, {
                id: 2,
                name: 'Priya Tech Solutions',
                phone: '+91 87654 32109',
                email: 'priya@priyatech.com',
                gst: '29AABCE0461R1Z0',
                city: 'Bangalore',
                state: 'Karnataka',
                address: 'Koramangala, Bangalore',
                outstanding: 125000,
                status: 'active'
            }, {
                id: 3,
                name: 'Global Retail India',
                phone: '+91 76543 21098',
                email: 'billing@globalretail.in',
                gst: '24AAACG4716H1ZA',
                city: 'Ahmedabad',
                state: 'Gujarat',
                address: 'Navrangpura, Ahmedabad',
                outstanding: 0,
                status: 'active'
            }, {
                id: 4,
                name: 'Sunrise Traders',
                phone: '+91 65432 10987',
                email: 'accounts@sunrisetraders.com',
                gst: '09AAPCS8186Q1ZY',
                city: 'Lucknow',
                state: 'UP',
                address: 'Hazratganj, Lucknow',
                outstanding: 78500,
                status: 'active'
            }, {
                id: 5,
                name: 'Digital Dreams Pvt Ltd',
                phone: '+91 54321 09876',
                email: 'finance@digitaldreams.io',
                gst: '33AABCD1234F1ZB',
                city: 'Chennai',
                state: 'Tamil Nadu',
                address: 'T Nagar, Chennai',
                outstanding: 230000,
                status: 'inactive'
            }, {
                id: 6,
                name: 'Metro Construction Co',
                phone: '+91 98112 34567',
                email: 'accounts@metroconstruct.in',
                gst: '36AAACM3456N1ZC',
                city: 'Hyderabad',
                state: 'Telangana',
                address: 'Hitech City, Hyderabad',
                outstanding: 55000,
                status: 'active'
            }]);
            DB.set('suppliers', [{
                id: 1,
                name: 'HP India Pvt Ltd',
                phone: '+91 80 6760 0000',
                email: 'partners@hp.com',
                gst: '29AAACH1104F1ZB',
                city: 'Bangalore',
                address: 'MG Road, Bangalore',
                balance: 240000,
                terms: '30 days'
            }, {
                id: 2,
                name: 'Dell EMC India',
                phone: '+91 22 4030 1234',
                email: 'enterprise@dell.in',
                gst: '27AABCD1234H1ZD',
                city: 'Mumbai',
                address: 'BKC, Mumbai',
                balance: 180000,
                terms: '45 days'
            }, {
                id: 3,
                name: 'Stationery World',
                phone: '+91 11 4567 9012',
                email: 'orders@stationeryworld.in',
                gst: '07AABCS3456J1ZE',
                city: 'Delhi',
                address: 'Connaught Place, Delhi',
                balance: 15000,
                terms: '15 days'
            }, {
                id: 4,
                name: 'Cloud Services Corp',
                phone: '+91 80 2345 6789',
                email: 'billing@cloudservices.in',
                gst: '29AABCC1234K1ZF',
                city: 'Bangalore',
                address: 'Whitefield, Bangalore',
                balance: 95000,
                terms: '30 days'
            }]);
            DB.set('products', [{
                id: 1,
                name: 'Dell Laptop XPS 15',
                category: 'Electronics',
                hsn: '84713010',
                unit: 'Nos',
                buyPrice: 75000,
                sellPrice: 89999,
                gstRate: 18,
                stock: 45,
                minStock: 5
            }, {
                id: 2,
                name: 'HP LaserJet Printer',
                category: 'Electronics',
                hsn: '84433100',
                unit: 'Nos',
                buyPrice: 18000,
                sellPrice: 24999,
                gstRate: 18,
                stock: 12,
                minStock: 3
            }, {
                id: 3,
                name: 'Office Chair Ergonomic',
                category: 'Furniture',
                hsn: '94013000',
                unit: 'Nos',
                buyPrice: 8000,
                sellPrice: 12999,
                gstRate: 18,
                stock: 30,
                minStock: 5
            }, {
                id: 4,
                name: 'A4 Paper Ream 500 Sheets',
                category: 'Office Supplies',
                hsn: '48010000',
                unit: 'Ream',
                buyPrice: 180,
                sellPrice: 280,
                gstRate: 12,
                stock: 8,
                minStock: 20
            }, {
                id: 5,
                name: 'Microsoft Office 365',
                category: 'Software',
                hsn: '85234100',
                unit: 'License',
                buyPrice: 6500,
                sellPrice: 9999,
                gstRate: 18,
                stock: 100,
                minStock: 10
            }, {
                id: 6,
                name: 'USB-C Hub 7-in-1',
                category: 'Hardware',
                hsn: '84717010',
                unit: 'Nos',
                buyPrice: 1200,
                sellPrice: 1999,
                gstRate: 18,
                stock: 3,
                minStock: 10
            }, {
                id: 7,
                name: 'Wireless Mouse Logitech',
                category: 'Hardware',
                hsn: '84716090',
                unit: 'Nos',
                buyPrice: 900,
                sellPrice: 1599,
                gstRate: 18,
                stock: 25,
                minStock: 10
            }, {
                id: 8,
                name: 'HDMI Cable 2m',
                category: 'Hardware',
                hsn: '85444290',
                unit: 'Nos',
                buyPrice: 150,
                sellPrice: 399,
                gstRate: 18,
                stock: 4,
                minStock: 15
            }]);
            const t = new Date(),
                fmt = d => d.toISOString().split('T')[0],
                ad = (d, n) => {
                    const x = new Date(d);
                    x.setDate(x.getDate() + n);
                    return x
                };
            DB.set('invoices', [{
                id: 1,
                number: 'INV-2024-001',
                date: fmt(ad(t, -25)),
                due: fmt(ad(t, -10)),
                customer: 'Rajesh Kumar Enterprises',
                items: [{
                    name: 'Dell Laptop XPS 15',
                    qty: 2,
                    rate: 89999,
                    gst: 18
                }],
                subtotal: 179998,
                gstTotal: 32400,
                total: 212398,
                status: 'paid'
            }, {
                id: 2,
                number: 'INV-2024-002',
                date: fmt(ad(t, -20)),
                due: fmt(ad(t, 5)),
                customer: 'Priya Tech Solutions',
                items: [{
                    name: 'HP LaserJet Printer',
                    qty: 5,
                    rate: 24999,
                    gst: 18
                }],
                subtotal: 124995,
                gstTotal: 22499,
                total: 147494,
                status: 'pending'
            }, {
                id: 3,
                number: 'INV-2024-003',
                date: fmt(ad(t, -18)),
                due: fmt(ad(t, -3)),
                customer: 'Global Retail India',
                items: [{
                    name: 'Office Chair Ergonomic',
                    qty: 10,
                    rate: 12999,
                    gst: 18
                }],
                subtotal: 129990,
                gstTotal: 23398,
                total: 153388,
                status: 'paid'
            }, {
                id: 4,
                number: 'INV-2024-004',
                date: fmt(ad(t, -15)),
                due: fmt(ad(t, -5)),
                customer: 'Sunrise Traders',
                items: [{
                    name: 'Microsoft Office 365',
                    qty: 20,
                    rate: 9999,
                    gst: 18
                }],
                subtotal: 199980,
                gstTotal: 35996,
                total: 235976,
                status: 'overdue'
            }, {
                id: 5,
                number: 'INV-2024-005',
                date: fmt(ad(t, -10)),
                due: fmt(ad(t, 20)),
                customer: 'Metro Construction Co',
                items: [{
                    name: 'USB-C Hub 7-in-1',
                    qty: 15,
                    rate: 1999,
                    gst: 18
                }],
                subtotal: 29985,
                gstTotal: 5397,
                total: 35382,
                status: 'pending'
            }, {
                id: 6,
                number: 'INV-2024-006',
                date: fmt(ad(t, -5)),
                due: fmt(ad(t, 25)),
                customer: 'Priya Tech Solutions',
                items: [{
                    name: 'Wireless Mouse Logitech',
                    qty: 30,
                    rate: 1599,
                    gst: 18
                }],
                subtotal: 47970,
                gstTotal: 8635,
                total: 56605,
                status: 'pending'
            }]);
            DB.set('purchases', [{
                id: 1,
                number: 'PO-2024-001',
                date: fmt(ad(t, -30)),
                supplier: 'HP India Pvt Ltd',
                product: 'HP LaserJet Printer',
                qty: 10,
                rate: 18000,
                gstRate: 18,
                total: 212400,
                status: 'received'
            }, {
                id: 2,
                number: 'PO-2024-002',
                date: fmt(ad(t, -25)),
                supplier: 'Dell EMC India',
                product: 'Dell Laptop XPS 15',
                qty: 5,
                rate: 75000,
                gstRate: 18,
                total: 442500,
                status: 'received'
            }, {
                id: 3,
                number: 'PO-2024-003',
                date: fmt(ad(t, -15)),
                supplier: 'Stationery World',
                product: 'A4 Paper Ream 500 Sheets',
                qty: 100,
                rate: 180,
                gstRate: 12,
                total: 20160,
                status: 'pending'
            }, {
                id: 4,
                number: 'PO-2024-004',
                date: fmt(ad(t, -8)),
                supplier: 'Cloud Services Corp',
                product: 'Microsoft Office 365',
                qty: 50,
                rate: 6500,
                gstRate: 18,
                total: 383500,
                status: 'received'
            }]);
            DB.set('payments', [{
                id: 1,
                date: fmt(ad(t, -28)),
                party: 'HP India Pvt Ltd',
                type: 'supplier',
                mode: 'Bank Transfer',
                ref: 'NEFT-29042024',
                amount: 212400,
                notes: 'PO-2024-001'
            }, {
                id: 2,
                date: fmt(ad(t, -20)),
                party: 'Dell EMC India',
                type: 'supplier',
                mode: 'RTGS',
                ref: 'RTGS-04052024',
                amount: 442500,
                notes: 'PO-2024-002'
            }, {
                id: 3,
                date: fmt(ad(t, -10)),
                party: 'Stationery World',
                type: 'supplier',
                mode: 'UPI',
                ref: 'UPI-14052024',
                amount: 10000,
                notes: 'Advance payment'
            }]);
            DB.set('receipts', [{
                id: 1,
                date: fmt(ad(t, -22)),
                customer: 'Rajesh Kumar Enterprises',
                invoice: 'INV-2024-001',
                mode: 'Bank Transfer',
                amount: 212398,
                notes: 'Full payment'
            }, {
                id: 2,
                date: fmt(ad(t, -15)),
                customer: 'Global Retail India',
                invoice: 'INV-2024-003',
                mode: 'NEFT',
                amount: 153388,
                notes: 'Full payment'
            }, {
                id: 3,
                date: fmt(ad(t, -5)),
                customer: 'Priya Tech Solutions',
                invoice: 'INV-2024-002',
                mode: 'UPI',
                amount: 50000,
                notes: 'Advance'
            }]);
            DB.set('expenses', [{
                id: 1,
                date: fmt(ad(t, -30)),
                category: 'Rent',
                amount: 85000,
                method: 'Bank Transfer',
                notes: 'Office rent'
            }, {
                id: 2,
                date: fmt(ad(t, -25)),
                category: 'Salary',
                amount: 450000,
                method: 'Bank Transfer',
                notes: 'Staff salary'
            }, {
                id: 3,
                date: fmt(ad(t, -20)),
                category: 'Utilities',
                amount: 12000,
                method: 'UPI',
                notes: 'Electricity + Internet'
            }, {
                id: 4,
                date: fmt(ad(t, -15)),
                category: 'Travel',
                amount: 8500,
                method: 'Cash',
                notes: 'Client visit'
            }, {
                id: 5,
                date: fmt(ad(t, -10)),
                category: 'Marketing',
                amount: 35000,
                method: 'Credit Card',
                notes: 'Google Ads'
            }, {
                id: 6,
                date: fmt(ad(t, -5)),
                category: 'Office Supplies',
                amount: 5600,
                method: 'Cash',
                notes: 'Stationery'
            }, {
                id: 7,
                date: fmt(ad(t, -2)),
                category: 'Maintenance',
                amount: 7200,
                method: 'Cash',
                notes: 'AC servicing'
            }]);
            DB.set('users', [{
                id: 1,
                name: 'Amit Kumar',
                email: 'amit@techcorp.in',
                role: 'Admin',
                status: 'active',
                lastLogin: 'Today 10:23 AM'
            }, {
                id: 2,
                name: 'Sneha Sharma',
                email: 'sneha@techcorp.in',
                role: 'Accountant',
                status: 'active',
                lastLogin: 'Today 09:15 AM'
            }, {
                id: 3,
                name: 'Rohit Verma',
                email: 'rohit@techcorp.in',
                role: 'Sales Manager',
                status: 'active',
                lastLogin: 'Yesterday 6:00 PM'
            }, {
                id: 4,
                name: 'Kavita Singh',
                email: 'kavita@techcorp.in',
                role: 'Viewer',
                status: 'inactive',
                lastLogin: '3 days ago'
            }]);
            DB.set('seeded', [{
                done: true
            }]);
        }

        /* ── UTILS ── */
        const fmt = n => '₹' + Number(n || 0).toLocaleString('en-IN', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
        const fmtN = n => Number(n || 0).toLocaleString('en-IN');
        const today = () => new Date().toISOString().split('T')[0];
        let chartInstances = {};

        function destroyChart(id) {
            if (chartInstances[id]) {
                chartInstances[id].destroy();
                delete chartInstances[id];
            }
        }

        /* ── TOAST ── */
        function toast(msg, type = 'info') {
            const icons = {
                success: 'fa-circle-check',
                error: 'fa-circle-xmark',
                info: 'fa-circle-info'
            };
            const el = document.createElement('div');
            el.className = `toast ${type}`;
            el.innerHTML = `<i class="fa-solid ${icons[type]}"></i><span>${msg}</span>`;
            document.getElementById('toast-container').appendChild(el);
            setTimeout(() => el.remove(), 3500);
        }

        /* ── MODAL ── */
        function openModal(id) {
            document.getElementById(id).classList.add('open');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
        }
        document.querySelectorAll('.modal-overlay').forEach(o => o.addEventListener('click', e => {
            if (e.target === o) o.classList.remove('open');
        }));

        /* ── THEME ── */
        const themeToggle = document.getElementById('theme-toggle');

        function applyTheme(dark) {
            document.documentElement.setAttribute('data-theme', dark ? 'dark' : 'light');
            localStorage.setItem('fl_theme', dark ? 'dark' : 'light');
            // Update chart defaults
            if (Chart.defaults) {
                Chart.defaults.color = dark ? '#8896b3' : '#64748b';
                Chart.defaults.borderColor = dark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.06)';
            }
        }
        themeToggle.addEventListener('click', () => {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            applyTheme(!isDark);
            // Re-render charts
            renderDashboard();
        });
        // Load saved theme
        (function() {
            const saved = localStorage.getItem('fl_theme');
            applyTheme(saved === 'dark');
        })();

        /* ── PROFILE DROPDOWN ── */
        const profileWrap = document.getElementById('profile-wrap');
        document.getElementById('profile-btn').addEventListener('click', e => {
            e.stopPropagation();
            profileWrap.classList.toggle('open');
        });
        document.addEventListener('click', () => profileWrap.classList.remove('open'));

        function closeProfileDropdown() {
            profileWrap.classList.remove('open');
        }

        /* ── SIDEBAR TOGGLE ── */
        document.getElementById('sidebar-toggle').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });

        /* ── SIDEBAR SUBMENUS ── */
        document.querySelectorAll('.nav-item.has-sub').forEach(item => {
            item.addEventListener('click', () => {
                const subId = item.dataset.sub;
                const sub = document.getElementById(subId);
                if (!sub) return;
                const isOpen = sub.classList.contains('open');
                // close all
                document.querySelectorAll('.submenu').forEach(s => s.classList.remove('open'));
                document.querySelectorAll('.nav-item.has-sub').forEach(i => i.classList.remove('submenu-open'));
                if (!isOpen) {
                    sub.classList.add('open');
                    item.classList.add('submenu-open');
                }
            });
        });

        /* ── NAVIGATION ── */
        const pageLabels = {
            dashboard: 'Dashboard',
            companies: 'Companies',
            customers: 'Customers',
            suppliers: 'Suppliers',
            products: 'Products',
            stock: 'Stock Summary',
            sales: 'Sales / Billing',
            purchases: 'Purchase Orders',
            payments: 'Payments',
            receipts: 'Receipts',
            expenses: 'Expenses',
            gst: 'GST / Tax',
            reports: 'Accounting Reports',
            users: 'User Management',
            settings: 'Settings'
        };

        function navigate(page) {
            document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.nav-item:not(.has-sub),.submenu-item').forEach(n => n.classList.remove('active'));
            const pageEl = document.getElementById('page-' + page);
            if (pageEl) pageEl.classList.add('active');
            // highlight nav
            const navEl = document.querySelector(`.nav-item[data-page="${page}"]`);
            if (navEl) navEl.classList.add('active');
            const subEl = document.querySelector(`.submenu-item[data-page="${page}"]`);
            if (subEl) subEl.classList.add('active');
            document.getElementById('breadcrumb').textContent = pageLabels[page] || page;
            renderPage(page);
        }

        document.querySelectorAll('.nav-item[data-page]').forEach(i => i.addEventListener('click', () => navigate(i.dataset.page)));
        document.querySelectorAll('.submenu-item[data-page]').forEach(i => i.addEventListener('click', () => navigate(i.dataset.page)));

        function renderPage(p) {
            ({
                dashboard: renderDashboard,
                companies: renderCompanies,
                customers: renderCustomers,
                suppliers: renderSuppliers,
                products: renderProducts,
                stock: renderStock,
                sales: renderSales,
                purchases: renderPurchases,
                payments: renderPayments,
                receipts: renderReceipts,
                expenses: renderExpenses,
                gst: renderGST,
                reports: renderReports,
                users: renderUsers,
                settings: renderSettings
            })[p]?.();
        }

        /* ── DASHBOARD ── */
        function renderDashboard() {
            const invoices = DB.get('invoices'),
                expenses = DB.get('expenses'),
                products = DB.get('products'),
                receipts = DB.get('receipts');
            const totalSales = invoices.reduce((s, i) => s + i.total, 0);
            const totalPurchases = DB.get('purchases').reduce((s, p) => s + p.total, 0);
            const totalExpenses = expenses.reduce((s, e) => s + e.amount, 0);
            const pendingPayments = invoices.filter(i => i.status !== 'paid').reduce((s, i) => s + i.total, 0);
            const profit = totalSales - totalPurchases - totalExpenses;
            const stockAlerts = products.filter(p => p.stock <= p.minStock).length;

            document.getElementById('dashboard-stats').innerHTML = `
    <div class="stat-card blue"><div class="stat-header"><div class="stat-label">Total Sales</div><div class="stat-icon blue"><i class="fa-solid fa-chart-line"></i></div></div><div class="stat-value">${fmt(totalSales)}</div><div class="stat-change up"><i class="fa-solid fa-arrow-trend-up"></i> 12.5% vs last month</div></div>
    <div class="stat-card green"><div class="stat-header"><div class="stat-label">Total Purchases</div><div class="stat-icon green"><i class="fa-solid fa-cart-shopping"></i></div></div><div class="stat-value">${fmt(totalPurchases)}</div><div class="stat-change up"><i class="fa-solid fa-arrow-trend-up"></i> 8.3% vs last month</div></div>
    <div class="stat-card orange"><div class="stat-header"><div class="stat-label">Total Expenses</div><div class="stat-icon orange"><i class="fa-solid fa-money-bill-wave"></i></div></div><div class="stat-value">${fmt(totalExpenses)}</div><div class="stat-change down"><i class="fa-solid fa-arrow-trend-up"></i> 3.1% vs last month</div></div>
    <div class="stat-card ${profit>=0?'green':'red'}"><div class="stat-header"><div class="stat-label">Net Profit</div><div class="stat-icon ${profit>=0?'green':'red'}"><i class="fa-solid fa-sack-dollar"></i></div></div><div class="stat-value" style="color:${profit>=0?'#10b981':'#ef4444'}">${fmt(Math.abs(profit))}</div><div class="stat-change ${profit>=0?'up':'down'}">${profit>=0?'<i class="fa-solid fa-circle-check"></i> Profitable':'<i class="fa-solid fa-triangle-exclamation"></i> Loss'}</div></div>
    <div class="stat-card red"><div class="stat-header"><div class="stat-label">Pending Payments</div><div class="stat-icon red"><i class="fa-solid fa-clock"></i></div></div><div class="stat-value" style="color:#f59e0b">${fmt(pendingPayments)}</div><div class="stat-change"><i class="fa-solid fa-file-invoice"></i> ${invoices.filter(i=>i.status!=='paid').length} invoices</div></div>
    <div class="stat-card purple"><div class="stat-header"><div class="stat-label">Stock Alerts</div><div class="stat-icon purple"><i class="fa-solid fa-triangle-exclamation"></i></div></div><div class="stat-value" style="color:#ef4444">${stockAlerts}</div><div class="stat-change down"><i class="fa-solid fa-boxes-stacked"></i> Items below min</div></div>
  `;

            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';
            const tickColor = isDark ? '#8896b3' : '#64748b';

            destroyChart('salesChart');
            chartInstances['salesChart'] = new Chart(document.getElementById('salesChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May'],
                    datasets: [{
                        label: 'Sales',
                        data: [185000, 225000, 312000, 198000, 245000, 289000, 356000, totalSales],
                        backgroundColor: 'rgba(59,130,246,0.75)',
                        borderColor: '#3b82f6',
                        borderWidth: 0,
                        borderRadius: 5
                    }, {
                        label: 'Purchases',
                        data: [120000, 145000, 198000, 135000, 165000, 180000, 210000, totalPurchases],
                        backgroundColor: 'rgba(16,185,129,0.55)',
                        borderColor: '#10b981',
                        borderWidth: 0,
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: tickColor,
                                font: {
                                    size: 11
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: tickColor,
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                color: gridColor
                            }
                        },
                        y: {
                            ticks: {
                                color: tickColor,
                                font: {
                                    size: 11
                                },
                                callback: v => '₹' + fmtN(v)
                            },
                            grid: {
                                color: gridColor
                            }
                        }
                    }
                }
            });

            const cats = {};
            expenses.forEach(e => cats[e.category] = (cats[e.category] || 0) + e.amount);
            destroyChart('expenseChart');
            chartInstances['expenseChart'] = new Chart(document.getElementById('expenseChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(cats),
                    datasets: [{
                        data: Object.values(cats),
                        backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#06b6d4', '#f97316'],
                        borderWidth: 0,
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: tickColor,
                                font: {
                                    size: 11
                                },
                                padding: 10
                            }
                        }
                    },
                    cutout: '66%'
                }
            });

            destroyChart('revenueChart');
            chartInstances['revenueChart'] = new Chart(document.getElementById('revenueChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                    datasets: [{
                        label: 'Revenue',
                        data: [198000, 245000, 289000, 356000, 312000, 425000, 398000, 467000],
                        borderColor: '#10b981',
                        backgroundColor: isDark ? 'rgba(16,185,129,0.08)' : 'rgba(16,185,129,0.07)',
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#10b981',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: tickColor,
                                font: {
                                    size: 11
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: tickColor,
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                color: gridColor
                            }
                        },
                        y: {
                            ticks: {
                                color: tickColor,
                                font: {
                                    size: 11
                                },
                                callback: v => '₹' + fmtN(v)
                            },
                            grid: {
                                color: gridColor
                            }
                        }
                    }
                }
            });

            const rTable = document.getElementById('recent-invoices-table');
            const recent = invoices.slice(-5).reverse();
            rTable.innerHTML = `<thead><tr><th>Invoice</th><th>Customer</th><th>Total</th><th>Status</th></tr></thead><tbody>${recent.map(i=>`<tr><td class="mono fw-600 text-blue">${i.number}</td><td>${i.customer}</td><td class="mono fw-600">${fmt(i.total)}</td><td><span class="badge badge-${i.status==='paid'?'success':i.status==='overdue'?'danger':'warning'}">${i.status}</span></td></tr>`).join('')}</tbody>`;

            const alerts = products.filter(p => p.stock <= p.minStock);
            document.getElementById('alert-count').textContent = alerts.length;
            const al = document.getElementById('stock-alerts-list');
            al.innerHTML = !alerts.length ? `<div class="empty-state"><i class="fa-solid fa-circle-check"></i><p>All products well-stocked</p></div>` : alerts.map(p => `<div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border)"><div><div style="font-size:13px;font-weight:600">${p.name}</div><div style="font-size:11px;color:var(--text-muted)">${p.category}</div></div><div style="text-align:right"><span class="badge badge-${p.stock===0?'danger':'warning'}">${p.stock} ${p.unit||'Nos'}</span><div style="font-size:10px;color:var(--text-muted);margin-top:2px">Min: ${p.minStock}</div></div></div>`).join('');

            const custSales = {};
            invoices.forEach(i => custSales[i.customer] = (custSales[i.customer] || 0) + i.total);
            const sorted = Object.entries(custSales).sort((a, b) => b[1] - a[1]).slice(0, 5);
            const maxS = sorted[0]?.[1] || 1;
            document.getElementById('top-customers-list').innerHTML = sorted.map(([n, a]) => `<div style="margin-bottom:14px"><div style="display:flex;justify-content:space-between;margin-bottom:5px;font-size:13px"><span style="font-weight:600">${n}</span><span class="mono text-blue">${fmt(a)}</span></div><div class="progress-bar-wrap"><div class="progress-bar" style="width:${(a/maxS*100).toFixed(0)}%;background:#3b82f6"></div></div></div>`).join('');
        }

        /* ── COMPANIES ── */
        function renderCompanies() {
            const companies = DB.get('companies');
            const grid = document.getElementById('companies-grid');
            if (!companies.length) {
                grid.innerHTML = '<div class="empty-state"><i class="fa-solid fa-building"></i><p>No companies added yet</p></div>';
                return;
            }
            grid.innerHTML = companies.map(c => `<div class="card"><div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:14px"><div style="display:flex;gap:12px;align-items:center"><div style="width:44px;height:44px;background:linear-gradient(135deg,#3b82f6,#8b5cf6);border-radius:11px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px"><i class="fa-solid fa-building"></i></div><div><div style="font-family:'Syne',sans-serif;font-weight:800;font-size:15px">${c.name}</div><div style="font-size:11px;color:var(--text-muted)">FY: ${c.fy}</div></div></div><span class="badge badge-success"><i class="fa-solid fa-circle" style="font-size:6px"></i> Active</span></div><div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;font-size:12px"><div><span style="color:var(--text-muted)">GST: </span><span class="mono">${c.gst||'—'}</span></div><div><span style="color:var(--text-muted)">PAN: </span><span class="mono">${c.pan||'—'}</span></div><div><i class="fa-solid fa-phone" style="color:var(--text-muted);width:14px"></i> ${c.phone||'—'}</div><div><i class="fa-solid fa-envelope" style="color:var(--text-muted);width:14px"></i> ${c.email||'—'}</div></div>${c.address?`<div style="margin-top:10px;font-size:11px;color:var(--text-muted)"><i class="fa-solid fa-location-dot"></i> ${c.address}</div>`:''}<div style="display:flex;gap:8px;margin-top:14px"><button class="btn btn-danger btn-sm" onclick="deleteItem('companies',${c.id},renderCompanies)"><i class="fa-solid fa-trash"></i> Delete</button></div></div>`).join('');
        }

        function saveCompany() {
            const name = document.getElementById('co-name').value.trim();
            if (!name) return toast('Company name required', 'error');
            const a = DB.get('companies');
            a.push({
                id: DB.nextId('companies'),
                name,
                gst: document.getElementById('co-gst').value,
                pan: document.getElementById('co-pan').value,
                phone: document.getElementById('co-phone').value,
                email: document.getElementById('co-email').value,
                address: document.getElementById('co-address').value,
                fy: document.getElementById('co-fy').value
            });
            DB.set('companies', a);
            closeModal('company-modal');
            renderCompanies();
            toast('Company added', 'success');
        }

        /* ── CUSTOMERS ── */
        let editCustId = null;

        function renderCustomers() {
            const s = document.getElementById('customer-search')?.value.toLowerCase() || '';
            const f = document.getElementById('customer-filter')?.value || '';
            let c = DB.get('customers');
            if (s) c = c.filter(x => x.name.toLowerCase().includes(s) || x.phone?.includes(s) || x.city?.toLowerCase().includes(s));
            if (f) c = c.filter(x => x.status === f);
            document.getElementById('customers-tbody').innerHTML = !c.length ? `<tr><td colspan="9" class="text-center text-muted" style="padding:32px">No customers found</td></tr>` : c.map((x, i) => `<tr><td style="color:var(--text-muted)">${i+1}</td><td><div class="fw-600">${x.name}</div></td><td>${x.phone||'—'}</td><td style="color:var(--text-muted)">${x.email||'—'}</td><td class="mono" style="font-size:11px">${x.gst||'—'}</td><td>${x.city||'—'}</td><td class="mono ${x.outstanding>0?'text-orange':''}">${fmt(x.outstanding||0)}</td><td><span class="badge badge-${x.status==='active'?'success':'muted'}">${x.status||'active'}</span></td><td><div style="display:flex;gap:4px"><button class="btn btn-secondary btn-sm" onclick="editCustomer(${x.id})"><i class="fa-solid fa-pen"></i></button><button class="btn btn-danger btn-sm" onclick="deleteItem('customers',${x.id},renderCustomers)"><i class="fa-solid fa-trash"></i></button></div></td></tr>`).join('');
        }

        function editCustomer(id) {
            const c = DB.get('customers').find(x => x.id === id);
            if (!c) return;
            editCustId = id;
            document.getElementById('customer-modal-title').innerHTML = '<i class="fa-solid fa-pen" style="color:var(--accent);margin-right:8px"></i>Edit Customer';
            ['name', 'phone', 'email', 'gst', 'city', 'state', 'address'].forEach(f => document.getElementById('cust-' + f).value = c[f] || '');
            openModal('customer-modal');
        }

        function saveCustomer() {
            const name = document.getElementById('cust-name').value.trim(),
                phone = document.getElementById('cust-phone').value.trim();
            if (!name || !phone) return toast('Name and phone required', 'error');
            let a = DB.get('customers');
            const d = {
                name,
                phone,
                email: document.getElementById('cust-email').value,
                gst: document.getElementById('cust-gst').value,
                city: document.getElementById('cust-city').value,
                state: document.getElementById('cust-state').value,
                address: document.getElementById('cust-address').value,
                status: 'active',
                outstanding: 0
            };
            if (editCustId) {
                a = a.map(x => x.id === editCustId ? {
                    ...x,
                    ...d
                } : x);
                toast('Customer updated', 'success');
            } else {
                a.push({
                    id: DB.nextId('customers'),
                    ...d
                });
                toast('Customer added', 'success');
            }
            DB.set('customers', a);
            editCustId = null;
            document.getElementById('customer-modal-title').innerHTML = '<i class="fa-solid fa-user-plus" style="color:var(--accent);margin-right:8px"></i>Add Customer';
            closeModal('customer-modal');
            renderCustomers();
        }

        /* ── SUPPLIERS ── */
        function renderSuppliers() {
            const s = document.getElementById('supplier-search')?.value.toLowerCase() || '';
            let a = DB.get('suppliers');
            if (s) a = a.filter(x => x.name.toLowerCase().includes(s) || x.city?.toLowerCase().includes(s));
            document.getElementById('suppliers-tbody').innerHTML = a.map((x, i) => `<tr><td style="color:var(--text-muted)">${i+1}</td><td><div class="fw-600">${x.name}</div><div style="font-size:11px;color:var(--text-muted)">${x.terms||'—'}</div></td><td>${x.phone||'—'}</td><td style="color:var(--text-muted)">${x.email||'—'}</td><td class="mono" style="font-size:11px">${x.gst||'—'}</td><td>${x.city||'—'}</td><td class="mono text-orange">${fmt(x.balance||0)}</td><td><button class="btn btn-danger btn-sm" onclick="deleteItem('suppliers',${x.id},renderSuppliers)"><i class="fa-solid fa-trash"></i></button></td></tr>`).join('');
        }

        function saveSupplier() {
            const name = document.getElementById('sup-name').value.trim();
            if (!name) return toast('Supplier name required', 'error');
            const a = DB.get('suppliers');
            a.push({
                id: DB.nextId('suppliers'),
                name,
                phone: document.getElementById('sup-phone').value,
                email: document.getElementById('sup-email').value,
                gst: document.getElementById('sup-gst').value,
                city: document.getElementById('sup-city').value,
                address: document.getElementById('sup-address').value,
                terms: document.getElementById('sup-terms').value,
                balance: 0
            });
            DB.set('suppliers', a);
            closeModal('supplier-modal');
            renderSuppliers();
            toast('Supplier added', 'success');
        }

        /* ── PRODUCTS ── */
        let editProdId = null;

        function renderProducts() {
            const s = document.getElementById('product-search')?.value.toLowerCase() || '';
            const cf = document.getElementById('product-category-filter')?.value || '';
            let a = DB.get('products');
            const cats = [...new Set(a.map(p => p.category))];
            const sel = document.getElementById('product-category-filter');
            if (sel && sel.options.length <= 1) cats.forEach(c => {
                const o = document.createElement('option');
                o.value = c;
                o.textContent = c;
                sel.appendChild(o);
            });
            if (s) a = a.filter(p => p.name.toLowerCase().includes(s) || p.category?.toLowerCase().includes(s));
            if (cf) a = a.filter(p => p.category === cf);
            const all = DB.get('products');
            document.getElementById('inventory-stats').innerHTML = `
    <div class="stat-card blue"><div class="stat-header"><div class="stat-label">Total Products</div><div class="stat-icon blue"><i class="fa-solid fa-boxes-stacked"></i></div></div><div class="stat-value">${all.length}</div></div>
    <div class="stat-card green"><div class="stat-header"><div class="stat-label">In Stock</div><div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div></div><div class="stat-value">${all.filter(p=>p.stock>p.minStock).length}</div></div>
    <div class="stat-card orange"><div class="stat-header"><div class="stat-label">Low Stock</div><div class="stat-icon orange"><i class="fa-solid fa-triangle-exclamation"></i></div></div><div class="stat-value">${all.filter(p=>p.stock>0&&p.stock<=p.minStock).length}</div></div>
    <div class="stat-card red"><div class="stat-header"><div class="stat-label">Out of Stock</div><div class="stat-icon red"><i class="fa-solid fa-circle-xmark"></i></div></div><div class="stat-value">${all.filter(p=>p.stock===0).length}</div></div>
  `;
            document.getElementById('products-tbody').innerHTML = a.map((p, i) => {
                const st = p.stock === 0 ? 'danger' : p.stock <= p.minStock ? 'warning' : 'success';
                const sl = p.stock === 0 ? 'Out of Stock' : p.stock <= p.minStock ? 'Low Stock' : 'In Stock';
                return `<tr><td style="color:var(--text-muted)">${i+1}</td><td><div class="fw-600">${p.name}</div><div style="font-size:11px;color:var(--text-muted)">${p.unit||'Nos'}</div></td><td><span class="tag">${p.category}</span></td><td class="mono" style="font-size:11px">${p.hsn||'—'}</td><td class="mono">${fmt(p.buyPrice)}</td><td class="mono text-blue fw-600">${fmt(p.sellPrice)}</td><td class="mono fw-700">${p.stock}</td><td class="mono text-muted">${p.minStock}</td><td><span class="badge badge-${st}">${sl}</span></td><td><div style="display:flex;gap:4px"><button class="btn btn-secondary btn-sm" onclick="editProduct(${p.id})"><i class="fa-solid fa-pen"></i></button><button class="btn btn-danger btn-sm" onclick="deleteItem('products',${p.id},renderProducts)"><i class="fa-solid fa-trash"></i></button></div></td></tr>`;
            }).join('');
        }

        function editProduct(id) {
            const p = DB.get('products').find(x => x.id === id);
            if (!p) return;
            editProdId = id;
            document.getElementById('product-modal-title').innerHTML = '<i class="fa-solid fa-pen" style="color:var(--accent);margin-right:8px"></i>Edit Product';
            document.getElementById('prod-name').value = p.name;
            document.getElementById('prod-category').value = p.category;
            document.getElementById('prod-hsn').value = p.hsn || '';
            document.getElementById('prod-unit').value = p.unit || '';
            document.getElementById('prod-buy').value = p.buyPrice;
            document.getElementById('prod-sell').value = p.sellPrice;
            document.getElementById('prod-gst').value = p.gstRate;
            document.getElementById('prod-stock').value = p.stock;
            document.getElementById('prod-min-stock').value = p.minStock;
            openModal('product-modal');
        }

        function saveProduct() {
            const name = document.getElementById('prod-name').value.trim();
            if (!name) return toast('Product name required', 'error');
            let a = DB.get('products');
            const d = {
                name,
                category: document.getElementById('prod-category').value,
                hsn: document.getElementById('prod-hsn').value,
                unit: document.getElementById('prod-unit').value,
                buyPrice: parseFloat(document.getElementById('prod-buy').value) || 0,
                sellPrice: parseFloat(document.getElementById('prod-sell').value) || 0,
                gstRate: parseFloat(document.getElementById('prod-gst').value) || 18,
                stock: parseInt(document.getElementById('prod-stock').value) || 0,
                minStock: parseInt(document.getElementById('prod-min-stock').value) || 10
            };
            if (editProdId) {
                a = a.map(p => p.id === editProdId ? {
                    ...p,
                    ...d
                } : p);
                toast('Product updated', 'success');
            } else {
                a.push({
                    id: DB.nextId('products'),
                    ...d
                });
                toast('Product added', 'success');
            }
            DB.set('products', a);
            editProdId = null;
            document.getElementById('product-modal-title').innerHTML = '<i class="fa-solid fa-box" style="color:var(--accent);margin-right:8px"></i>Add Product';
            closeModal('product-modal');
            renderProducts();
        }

        /* ── STOCK SUMMARY ── */
        function renderStock() {
            const products = DB.get('products');
            document.getElementById('stock-tbody').innerHTML = products.map(p => {
                const st = p.stock === 0 ? 'danger' : p.stock <= p.minStock ? 'warning' : 'success';
                return `<tr><td class="fw-600">${p.name}</td><td><span class="tag">${p.category}</span></td><td class="mono">${p.stock}</td><td class="mono text-green">0</td><td class="mono text-red">0</td><td class="mono fw-700">${p.stock}</td><td class="mono text-blue">${fmt(p.stock*p.sellPrice)}</td><td><span class="badge badge-${st}">${p.stock===0?'Out of Stock':p.stock<=p.minStock?'Low Stock':'In Stock'}</span></td></tr>`;
            }).join('');
        }

        /* ── SALES ── */
        function renderSales() {
            const invoices = DB.get('invoices');
            const s = document.getElementById('invoice-search')?.value.toLowerCase() || '';
            const sf = document.getElementById('invoice-status-filter')?.value || '';
            let f = invoices;
            if (s) f = f.filter(i => i.number.toLowerCase().includes(s) || i.customer.toLowerCase().includes(s));
            if (sf) f = f.filter(i => i.status === sf);
            const tS = invoices.reduce((s, i) => s + i.total, 0),
                paid = invoices.filter(i => i.status === 'paid').reduce((s, i) => s + i.total, 0),
                pend = invoices.filter(i => i.status === 'pending').reduce((s, i) => s + i.total, 0),
                over = invoices.filter(i => i.status === 'overdue').reduce((s, i) => s + i.total, 0);
            document.getElementById('sales-stats').innerHTML = `
    <div class="stat-card blue"><div class="stat-header"><div class="stat-label">Total Billed</div><div class="stat-icon blue"><i class="fa-solid fa-file-invoice-dollar"></i></div></div><div class="stat-value">${fmt(tS)}</div></div>
    <div class="stat-card green"><div class="stat-header"><div class="stat-label">Collected</div><div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div></div><div class="stat-value">${fmt(paid)}</div></div>
    <div class="stat-card orange"><div class="stat-header"><div class="stat-label">Pending</div><div class="stat-icon orange"><i class="fa-solid fa-clock"></i></div></div><div class="stat-value">${fmt(pend)}</div></div>
    <div class="stat-card red"><div class="stat-header"><div class="stat-label">Overdue</div><div class="stat-icon red"><i class="fa-solid fa-circle-exclamation"></i></div></div><div class="stat-value">${fmt(over)}</div></div>
  `;
            const cs = document.getElementById('inv-customer');
            cs.innerHTML = DB.get('customers').map(c => `<option>${c.name}</option>`).join('');
            document.getElementById('inv-date').value = today();
            const dd = new Date();
            dd.setDate(dd.getDate() + 30);
            document.getElementById('inv-due').value = dd.toISOString().split('T')[0];
            document.getElementById('invoices-tbody').innerHTML = f.map(i => `<tr><td class="mono fw-600 text-blue">${i.number}</td><td>${i.date}</td><td>${i.customer}</td><td style="color:var(--text-muted)">${i.items?.length||0} item(s)</td><td class="mono">${fmt(i.subtotal)}</td><td class="mono">${fmt(i.gstTotal)}</td><td class="mono fw-700">${fmt(i.total)}</td><td><span class="badge badge-${i.status==='paid'?'success':i.status==='overdue'?'danger':'warning'}">${i.status}</span></td><td><div style="display:flex;gap:4px"><button class="btn btn-secondary btn-sm" onclick="showInvoicePreview(${i.id})"><i class="fa-solid fa-eye"></i></button>${i.status!=='paid'?`<button class="btn btn-success btn-sm" onclick="markPaid(${i.id})"><i class="fa-solid fa-check"></i></button>`:''}<button class="btn btn-danger btn-sm" onclick="deleteItem('invoices',${i.id},renderSales)"><i class="fa-solid fa-trash"></i></button></div></td></tr>`).join('');
            if (!document.getElementById('line-items-tbody').children.length) addLineItem();
        }

        function markPaid(id) {
            let a = DB.get('invoices');
            a = a.map(i => i.id === id ? {
                ...i,
                status: 'paid'
            } : i);
            DB.set('invoices', a);
            renderSales();
            toast('Invoice marked as paid', 'success');
        }

        let liCount = 0;

        function addLineItem() {
            const prods = DB.get('products');
            const tbody = document.getElementById('line-items-tbody');
            const id = ++liCount;
            const row = document.createElement('tr');
            row.id = `li-${id}`;
            row.innerHTML = `<td><select class="form-select" onchange="liProdChange(${id},this)" style="min-width:180px">${prods.map(p=>`<option value="${p.id}" data-rate="${p.sellPrice}" data-gst="${p.gstRate}">${p.name}</option>`).join('')}</select></td><td><input type="number" value="1" min="1" oninput="calcLi(${id})" id="lq-${id}" style="width:70px"></td><td><input type="number" value="${prods[0]?.sellPrice||0}" oninput="calcLi(${id})" id="lr-${id}" style="width:100px"></td><td><select id="lg-${id}" onchange="calcLi(${id})" style="width:70px"><option value="0">0%</option><option value="5">5%</option><option value="12">12%</option><option value="18" selected>18%</option><option value="28">28%</option></select></td><td class="mono" id="lc-${id}" style="font-size:12px">₹0</td><td class="mono" id="ls-${id}" style="font-size:12px">₹0</td><td class="mono fw-600" id="lt-${id}">₹0</td><td><span class="remove-line" onclick="removeLi(${id})"><i class="fa-solid fa-xmark"></i></span></td>`;
            tbody.appendChild(row);
            if (prods[0]) document.getElementById(`lg-${id}`).value = prods[0].gstRate;
            calcLi(id);
        }

        function liProdChange(id, sel) {
            const o = sel.selectedOptions[0];
            document.getElementById(`lr-${id}`).value = o.dataset.rate || 0;
            document.getElementById(`lg-${id}`).value = o.dataset.gst || 18;
            calcLi(id);
        }

        function calcLi(id) {
            const q = parseFloat(document.getElementById(`lq-${id}`)?.value) || 0,
                r = parseFloat(document.getElementById(`lr-${id}`)?.value) || 0,
                g = parseFloat(document.getElementById(`lg-${id}`)?.value) || 0;
            const sub = q * r,
                gst = sub * g / 100;
            document.getElementById(`lc-${id}`).textContent = fmt(gst / 2);
            document.getElementById(`ls-${id}`).textContent = fmt(gst / 2);
            document.getElementById(`lt-${id}`).textContent = fmt(sub + gst);
            updateInvTotals();
        }

        function removeLi(id) {
            document.getElementById(`li-${id}`)?.remove();
            updateInvTotals();
        }

        function updateInvTotals() {
            let sub = 0,
                gst = 0;
            document.querySelectorAll('[id^="lt-"]').forEach(el => {
                const id = el.id.replace('lt-', '');
                const q = parseFloat(document.getElementById(`lq-${id}`)?.value) || 0,
                    r = parseFloat(document.getElementById(`lr-${id}`)?.value) || 0,
                    g = parseFloat(document.getElementById(`lg-${id}`)?.value) || 0;
                const s = q * r;
                sub += s;
                gst += s * g / 100;
            });
            document.getElementById('inv-subtotal').textContent = fmt(sub);
            document.getElementById('inv-gst-total').textContent = fmt(gst);
            document.getElementById('inv-grand-total').textContent = fmt(sub + gst);
        }

        function saveInvoice() {
            const customer = document.getElementById('inv-customer').value;
            if (!customer) return toast('Select a customer', 'error');
            const items = [];
            document.querySelectorAll('[id^="lt-"]').forEach(el => {
                const id = el.id.replace('lt-', '');
                const sel = document.querySelector(`#li-${id} select`);
                if (!sel) return;
                const q = parseFloat(document.getElementById(`lq-${id}`)?.value) || 0,
                    r = parseFloat(document.getElementById(`lr-${id}`)?.value) || 0,
                    g = parseFloat(document.getElementById(`lg-${id}`)?.value) || 0;
                if (q > 0 && r > 0) items.push({
                    name: sel.selectedOptions[0]?.text || '',
                    qty: q,
                    rate: r,
                    gst: g
                });
            });
            if (!items.length) return toast('Add at least one line item', 'error');
            const sub = items.reduce((s, i) => s + (i.qty * i.rate), 0),
                gst = items.reduce((s, i) => s + (i.qty * i.rate * i.gst / 100), 0);
            const a = DB.get('invoices');
            const num = 'INV-2024-' + String(a.length + 1).padStart(3, '0');
            a.push({
                id: DB.nextId('invoices'),
                number: num,
                date: document.getElementById('inv-date').value,
                due: document.getElementById('inv-due').value,
                customer,
                items,
                subtotal: sub,
                gstTotal: gst,
                total: sub + gst,
                status: 'pending'
            });
            DB.set('invoices', a);
            closeModal('invoice-modal');
            document.getElementById('line-items-tbody').innerHTML = '';
            liCount = 0;
            renderSales();
            toast('Invoice created: ' + num, 'success');
        }

        function previewInvoice() {
            const customer = document.getElementById('inv-customer').value || 'Customer',
                date = document.getElementById('inv-date').value;
            const items = [];
            document.querySelectorAll('[id^="lt-"]').forEach(el => {
                const id = el.id.replace('lt-', '');
                const sel = document.querySelector(`#li-${id} select`);
                if (!sel) return;
                const q = parseFloat(document.getElementById(`lq-${id}`)?.value) || 0,
                    r = parseFloat(document.getElementById(`lr-${id}`)?.value) || 0,
                    g = parseFloat(document.getElementById(`lg-${id}`)?.value) || 0;
                if (q > 0) items.push({
                    name: sel.selectedOptions[0]?.text || '',
                    qty: q,
                    rate: r,
                    gst: g
                });
            });
            const sub = items.reduce((s, i) => s + (i.qty * i.rate), 0),
                gst = items.reduce((s, i) => s + (i.qty * i.rate * i.gst / 100), 0);
            generateInvHTML({
                number: 'INV-PREVIEW',
                date,
                customer,
                items,
                subtotal: sub,
                gstTotal: gst,
                total: sub + gst
            });
            closeModal('invoice-modal');
            openModal('invoice-preview-modal');
        }

        function showInvoicePreview(id) {
            const inv = DB.get('invoices').find(i => i.id === id);
            if (!inv) return;
            generateInvHTML(inv);
            openModal('invoice-preview-modal');
        }

        function generateInvHTML(inv) {
            const co = DB.get('companies')[0] || {
                name: 'TechCorp India Pvt Ltd',
                address: 'Mumbai',
                gst: '27AABCU9603R1ZX'
            };
            const rows = inv.items.map(it => {
                const s = it.qty * it.rate,
                    g = s * it.gst / 100;
                return `<tr><td>${it.name}</td><td style="text-align:center">${it.qty}</td><td style="text-align:right">₹${Number(it.rate).toLocaleString('en-IN',{minimumFractionDigits:2})}</td><td style="text-align:center">${it.gst}%</td><td style="text-align:right">₹${Number(g/2).toLocaleString('en-IN',{minimumFractionDigits:2})}</td><td style="text-align:right">₹${Number(g/2).toLocaleString('en-IN',{minimumFractionDigits:2})}</td><td style="text-align:right;font-weight:600">₹${Number(s+g).toLocaleString('en-IN',{minimumFractionDigits:2})}</td></tr>`;
            }).join('');
            document.getElementById('invoice-print-area').innerHTML = `<div class="invoice-preview"><div class="inv-header"><div><div class="inv-company-name">${co.name}</div><div class="inv-company-details">${co.address}<br>GST: ${co.gst||'—'}<br>${co.phone||''} | ${co.email||''}</div></div><div style="text-align:right"><div class="inv-badge">TAX INVOICE</div><div class="inv-number">${inv.number}</div><div style="font-size:12px;color:#666;margin-top:4px">Date: ${inv.date}</div>${inv.due?`<div style="font-size:11px;color:#999">Due: ${inv.due}</div>`:''}</div></div><div class="inv-divider"></div><div class="inv-parties"><div><div class="inv-party-label">Bill To</div><div class="inv-party-name">${inv.customer}</div></div><div><div class="inv-party-label">Ship To</div><div class="inv-party-name">${inv.customer}</div></div></div><table class="inv-table"><thead><tr><th>Description</th><th style="text-align:center">Qty</th><th style="text-align:right">Rate</th><th style="text-align:center">GST%</th><th style="text-align:right">CGST</th><th style="text-align:right">SGST</th><th style="text-align:right">Amount</th></tr></thead><tbody>${rows}</tbody></table><div class="inv-totals"><div class="inv-totals-inner"><div class="inv-total-row"><span>Subtotal</span><span>₹${Number(inv.subtotal).toLocaleString('en-IN',{minimumFractionDigits:2})}</span></div><div class="inv-total-row"><span>CGST</span><span>₹${Number(inv.gstTotal/2).toLocaleString('en-IN',{minimumFractionDigits:2})}</span></div><div class="inv-total-row"><span>SGST</span><span>₹${Number(inv.gstTotal/2).toLocaleString('en-IN',{minimumFractionDigits:2})}</span></div><div class="inv-total-row inv-total-final"><span>Grand Total</span><span>₹${Number(inv.total).toLocaleString('en-IN',{minimumFractionDigits:2})}</span></div></div></div><div class="inv-footer-note">Computer-generated invoice — no physical signature required. Thank you for your business!</div></div>`;
        }

        /* ── PURCHASES ── */
        function renderPurchases() {
            const ps = DB.get('purchases');
            document.getElementById('pur-supplier').innerHTML = DB.get('suppliers').map(s => `<option>${s.name}</option>`).join('');
            document.getElementById('pur-product').innerHTML = DB.get('products').map(p => `<option value="${p.id}" data-rate="${p.buyPrice}" data-gst="${p.gstRate}">${p.name}</option>`).join('');
            document.getElementById('pur-date').value = today();
            document.getElementById('purchases-tbody').innerHTML = ps.map(p => `<tr><td class="mono fw-600 text-blue">${p.number}</td><td>${p.date}</td><td>${p.supplier}</td><td>${p.product}</td><td class="mono">${p.qty}</td><td class="mono">${fmt(p.rate)}</td><td><span class="badge badge-info">${p.gstRate}%</span></td><td class="mono fw-700">${fmt(p.total)}</td><td><span class="badge badge-${p.status==='received'?'success':'warning'}">${p.status}</span></td></tr>`).join('');
        }

        function fillPurchaseRate() {
            const sel = document.getElementById('pur-product'),
                o = sel.selectedOptions[0];
            document.getElementById('pur-rate').value = o?.dataset.rate || 0;
            document.getElementById('pur-gst').value = o?.dataset.gst || 18;
            calcPurchaseTotal();
        }

        function calcPurchaseTotal() {
            const q = parseFloat(document.getElementById('pur-qty').value) || 0,
                r = parseFloat(document.getElementById('pur-rate').value) || 0,
                g = parseFloat(document.getElementById('pur-gst').value) || 0;
            document.getElementById('pur-total').value = (q * r * (1 + g / 100)).toFixed(2);
        }

        function savePurchase() {
            const sup = document.getElementById('pur-supplier').value,
                sel = document.getElementById('pur-product'),
                prod = sel.selectedOptions[0]?.text,
                pid = parseInt(sel.value),
                qty = parseInt(document.getElementById('pur-qty').value) || 0,
                rate = parseFloat(document.getElementById('pur-rate').value) || 0,
                gst = parseFloat(document.getElementById('pur-gst').value) || 0;
            if (!qty || !rate) return toast('Fill quantity and rate', 'error');
            const a = DB.get('purchases');
            const num = 'PO-2024-' + String(a.length + 1).padStart(3, '0');
            a.push({
                id: DB.nextId('purchases'),
                number: num,
                date: document.getElementById('pur-date').value,
                supplier: sup,
                product: prod,
                qty,
                rate,
                gstRate: gst,
                total: qty * rate * (1 + gst / 100),
                status: 'pending'
            });
            DB.set('purchases', a);
            let prods = DB.get('products');
            prods = prods.map(p => p.id === pid ? {
                ...p,
                stock: p.stock + qty
            } : p);
            DB.set('products', prods);
            closeModal('purchase-modal');
            renderPurchases();
            toast('Purchase recorded & stock updated', 'success');
        }

        /* ── PAYMENTS ── */
        function renderPayments() {
            document.getElementById('pay-date').value = today();
            document.getElementById('payments-tbody').innerHTML = DB.get('payments').map((p, i) => `<tr><td style="color:var(--text-muted)">${i+1}</td><td>${p.date}</td><td class="fw-600">${p.party}</td><td><span class="badge badge-${p.type==='supplier'?'info':'success'}">${p.type}</span></td><td><span class="tag">${p.mode}</span></td><td class="mono" style="font-size:11px">${p.ref||'—'}</td><td class="mono fw-600 text-red">${fmt(p.amount)}</td><td style="color:var(--text-muted)">${p.notes||'—'}</td></tr>`).join('');
        }

        function savePayment() {
            const party = document.getElementById('pay-party').value.trim(),
                amount = parseFloat(document.getElementById('pay-amount').value) || 0;
            if (!party || !amount) return toast('Party name and amount required', 'error');
            const a = DB.get('payments');
            a.push({
                id: DB.nextId('payments'),
                party,
                amount,
                type: document.getElementById('pay-type').value,
                mode: document.getElementById('pay-mode').value,
                ref: document.getElementById('pay-ref').value,
                date: document.getElementById('pay-date').value,
                notes: document.getElementById('pay-notes').value
            });
            DB.set('payments', a);
            closeModal('payment-modal');
            renderPayments();
            toast('Payment recorded', 'success');
        }

        /* ── RECEIPTS ── */
        function renderReceipts() {
            document.getElementById('rec-date').value = today();
            document.getElementById('rec-customer').innerHTML = DB.get('customers').map(c => `<option>${c.name}</option>`).join('');
            document.getElementById('rec-invoice').innerHTML = '<option value="">Select Invoice</option>' + DB.get('invoices').filter(i => i.status !== 'paid').map(i => `<option>${i.number}</option>`).join('');
            document.getElementById('receipts-tbody').innerHTML = DB.get('receipts').map((r, i) => `<tr><td style="color:var(--text-muted)">${i+1}</td><td>${r.date}</td><td class="fw-600">${r.customer}</td><td class="mono text-blue">${r.invoice||'—'}</td><td><span class="tag">${r.mode}</span></td><td class="mono fw-600 text-green">${fmt(r.amount)}</td><td style="color:var(--text-muted)">${r.notes||'—'}</td></tr>`).join('');
        }

        function saveReceipt() {
            const customer = document.getElementById('rec-customer').value,
                amount = parseFloat(document.getElementById('rec-amount').value) || 0;
            if (!amount) return toast('Amount required', 'error');
            const a = DB.get('receipts');
            a.push({
                id: DB.nextId('receipts'),
                customer,
                amount,
                invoice: document.getElementById('rec-invoice').value,
                mode: document.getElementById('rec-mode').value,
                date: document.getElementById('rec-date').value,
                notes: document.getElementById('rec-notes').value
            });
            DB.set('receipts', a);
            closeModal('receipt-modal');
            renderReceipts();
            toast('Receipt recorded', 'success');
        }

        /* ── EXPENSES ── */
        function renderExpenses() {
            document.getElementById('exp-date').value = today();
            const exps = DB.get('expenses'),
                cats = {};
            exps.forEach(e => cats[e.category] = (cats[e.category] || 0) + e.amount);
            document.getElementById('expense-stats').innerHTML = `
    <div class="stat-card red"><div class="stat-header"><div class="stat-label">Total Expenses</div><div class="stat-icon red"><i class="fa-solid fa-money-bill-wave"></i></div></div><div class="stat-value">${fmt(exps.reduce((s,e)=>s+e.amount,0))}</div></div>
    <div class="stat-card orange"><div class="stat-header"><div class="stat-label">This Month</div><div class="stat-icon orange"><i class="fa-solid fa-calendar-days"></i></div></div><div class="stat-value">${fmt(exps.slice(-5).reduce((s,e)=>s+e.amount,0))}</div></div>
    <div class="stat-card purple"><div class="stat-header"><div class="stat-label">Categories</div><div class="stat-icon purple"><i class="fa-solid fa-tags"></i></div></div><div class="stat-value">${Object.keys(cats).length}</div></div>
    <div class="stat-card blue"><div class="stat-header"><div class="stat-label">Transactions</div><div class="stat-icon blue"><i class="fa-solid fa-list-check"></i></div></div><div class="stat-value">${exps.length}</div></div>
  `;
            document.getElementById('expenses-tbody').innerHTML = exps.map((e, i) => `<tr><td style="color:var(--text-muted)">${i+1}</td><td>${e.date}</td><td><span class="tag">${e.category}</span></td><td>${e.notes||'—'}</td><td class="mono fw-600 text-red">${fmt(e.amount)}</td><td><span class="tag">${e.method}</span></td></tr>`).join('');
        }

        function saveExpense() {
            const amount = parseFloat(document.getElementById('exp-amount').value) || 0;
            if (!amount) return toast('Amount required', 'error');
            const a = DB.get('expenses');
            a.push({
                id: DB.nextId('expenses'),
                amount,
                category: document.getElementById('exp-category').value,
                method: document.getElementById('exp-method').value,
                date: document.getElementById('exp-date').value,
                notes: document.getElementById('exp-notes').value
            });
            DB.set('expenses', a);
            closeModal('expense-modal');
            renderExpenses();
            toast('Expense recorded', 'success');
        }

        /* ── GST ── */
        function renderGST() {
            const inv = DB.get('invoices');
            let cgst = 0,
                sgst = 0,
                taxable = 0;
            inv.forEach(i => {
                taxable += i.subtotal || 0;
                cgst += (i.gstTotal || 0) / 2;
                sgst += (i.gstTotal || 0) / 2;
            });
            document.getElementById('gst-content').innerHTML = `
    <div class="report-summary">
      <div class="report-box"><div class="report-box-label">Taxable Value</div><div class="report-box-value">${fmt(taxable)}</div></div>
      <div class="report-box"><div class="report-box-label">CGST Collected</div><div class="report-box-value text-blue">${fmt(cgst)}</div></div>
      <div class="report-box"><div class="report-box-label">SGST Collected</div><div class="report-box-value text-blue">${fmt(sgst)}</div></div>
      <div class="report-box"><div class="report-box-label">IGST</div><div class="report-box-value">₹0.00</div></div>
      <div class="report-box"><div class="report-box-label">Total Liability</div><div class="report-box-value text-orange">${fmt(cgst+sgst)}</div></div>
    </div>
    <div class="card" style="margin-bottom:14px">
      <div class="card-title">GSTR-1 Summary — Outward Supplies</div>
      <div class="table-wrapper"><table class="data-table"><thead><tr><th>Invoice #</th><th>Date</th><th>Customer</th><th>Taxable</th><th>CGST</th><th>SGST</th><th>Total Tax</th><th>Invoice Total</th></tr></thead><tbody>${inv.map(i=>`<tr><td class="mono text-blue fw-600">${i.number}</td><td>${i.date}</td><td>${i.customer}</td><td class="mono">${fmt(i.subtotal)}</td><td class="mono">${fmt((i.gstTotal||0)/2)}</td><td class="mono">${fmt((i.gstTotal||0)/2)}</td><td class="mono text-orange">${fmt(i.gstTotal)}</td><td class="mono fw-700">${fmt(i.total)}</td></tr>`).join('')}</tbody></table></div>
    </div>
    <div class="grid-2">
      <div class="card"><div class="card-title">Rate-wise GST Summary</div>${[0,5,12,18,28].map(r=>{const rv=inv.filter(i=>i.items?.some(it=>it.gst===r)),ta=rv.reduce((s,i)=>s+(i.subtotal||0),0);return`<div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border);font-size:13px"><span><span class="badge badge-info">${r}%</span> GST</span><span class="mono">${fmt(ta)}</span><span class="mono text-orange">${fmt(ta*r/100)}</span></div>`;}).join('')}</div>
      <div class="card"><div class="card-title">Input Tax Credit (ITC)</div>${DB.get('purchases').map(p=>`<div style="display:flex;justify-content:space-between;align-items:center;padding:9px 0;border-bottom:1px solid var(--border);font-size:13px"><div><div class="fw-600">${p.product}</div><div style="font-size:11px;color:var(--text-muted)">${p.supplier}</div></div><div class="text-green mono fw-600">${fmt(p.total*p.gstRate/(100+p.gstRate))}</div></div>`).join('')}</div>
    </div>
  `;
        }

        /* ── REPORTS ── */
        function renderReports() {
            const inv = DB.get('invoices'),
                pur = DB.get('purchases'),
                exp = DB.get('expenses');
            const tS = inv.reduce((s, i) => s + i.total, 0),
                tP = pur.reduce((s, p) => s + p.total, 0),
                tE = exp.reduce((s, e) => s + e.amount, 0);
            const gP = tS - tP,
                nP = gP - tE;
            document.getElementById('reports-content').innerHTML = `
    <div style="display:flex;gap:8px;margin-bottom:16px;flex-wrap:wrap">
      <button class="btn btn-primary"><i class="fa-solid fa-chart-column"></i> P&L Statement</button>
      <button class="btn btn-secondary" onclick="toast('Balance Sheet — coming soon','info')"><i class="fa-solid fa-scale-balanced"></i> Balance Sheet</button>
      <button class="btn btn-secondary" onclick="toast('Trial Balance — coming soon','info')"><i class="fa-solid fa-list"></i> Trial Balance</button>
      <button class="btn btn-secondary" onclick="toast('Day Book — coming soon','info')"><i class="fa-solid fa-calendar-days"></i> Day Book</button>
    </div>
    <div class="card">
      <div class="card-title" style="font-size:16px;text-transform:none;letter-spacing:0;font-family:'Syne',sans-serif">Profit & Loss Statement</div>
      <div style="font-size:12px;color:var(--text-muted);margin-bottom:20px">For the period ending ${today()}</div>
      <div class="grid-2">
        <div>
          <div style="font-family:'Syne',sans-serif;font-weight:800;margin-bottom:10px;padding-bottom:8px;border-bottom:2px solid #3b82f6;color:var(--text-primary)">INCOME</div>
          <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--border);font-size:13px"><span>Sales Revenue</span><span class="mono text-green fw-600">${fmt(tS)}</span></div>
          <div style="display:flex;justify-content:space-between;padding:10px 0;font-weight:700;font-size:13px"><span>Total Income</span><span class="mono text-green">${fmt(tS)}</span></div>
          <div style="font-family:'Syne',sans-serif;font-weight:800;margin:16px 0 10px;padding-bottom:8px;border-bottom:2px solid #ef4444;color:var(--text-primary)">EXPENSES</div>
          <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--border);font-size:13px"><span>Cost of Goods Sold</span><span class="mono fw-600">${fmt(tP)}</span></div>
          ${exp.map(e=>`<div style="display:flex;justify-content:space-between;padding:6px 0;border-bottom:1px solid var(--border);font-size:12px"><span style="color:var(--text-muted)"><i class="fa-solid fa-minus" style="font-size:9px;margin-right:6px"></i>${e.category}</span><span class="mono">${fmt(e.amount)}</span></div>`).join('')}
          <div style="display:flex;justify-content:space-between;padding:10px 0;font-weight:700;font-size:13px"><span>Total Expenses</span><span class="mono text-red">${fmt(tP+tE)}</span></div>
        </div>
        <div>
          <div style="font-family:'Syne',sans-serif;font-weight:800;margin-bottom:10px;padding-bottom:8px;border-bottom:2px solid #10b981;color:var(--text-primary)">SUMMARY</div>
          <div class="report-box" style="margin-bottom:10px"><div class="report-box-label">Gross Profit</div><div class="report-box-value ${gP>=0?'text-green':'text-red'}">${fmt(Math.abs(gP))}</div></div>
          <div class="report-box" style="margin-bottom:10px"><div class="report-box-label">Operating Expenses</div><div class="report-box-value text-red">${fmt(tE)}</div></div>
          <div class="report-box" style="margin-bottom:10px;border:2px solid ${nP>=0?'#10b981':'#ef4444'}"><div class="report-box-label">Net ${nP>=0?'Profit':'Loss'}</div><div class="report-box-value ${nP>=0?'text-green':'text-red'}" style="font-size:26px">${nP>=0?'+':'-'}${fmt(Math.abs(nP))}</div></div>
          <div style="font-size:12px;color:var(--text-muted)"><i class="fa-solid fa-percent"></i> Profit Margin: <strong>${tS>0?((nP/tS)*100).toFixed(1):'0'}%</strong></div>
        </div>
      </div>
    </div>
  `;
        }

        /* ── USERS ── */
        function renderUsers() {
            const roleColor = {
                Admin: 'danger',
                Accountant: 'info',
                'Sales Manager': 'success',
                'Purchase Manager': 'warning',
                Viewer: 'muted'
            };
            document.getElementById('users-tbody').innerHTML = DB.get('users').map((u, i) => `<tr><td style="color:var(--text-muted)">${i+1}</td><td><div style="display:flex;align-items:center;gap:10px"><div style="width:30px;height:30px;border-radius:7px;background:linear-gradient(135deg,#3b82f6,#8b5cf6);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#fff">${u.name.slice(0,2).toUpperCase()}</div><span class="fw-600">${u.name}</span></div></td><td style="color:var(--text-muted)">${u.email}</td><td><span class="badge badge-${roleColor[u.role]||'info'}">${u.role}</span></td><td><span class="badge badge-${u.status==='active'?'success':'muted'}">${u.status}</span></td><td style="color:var(--text-muted);font-size:12px">${u.lastLogin}</td><td><div style="display:flex;gap:4px"><button class="btn btn-secondary btn-sm"><i class="fa-solid fa-pen"></i></button><button class="btn btn-danger btn-sm" onclick="deleteItem('users',${u.id},renderUsers)"><i class="fa-solid fa-trash"></i></button></div></td></tr>`).join('');
        }

        function saveUser() {
            const name = document.getElementById('usr-name').value.trim(),
                email = document.getElementById('usr-email').value.trim();
            if (!name || !email) return toast('Name and email required', 'error');
            const a = DB.get('users');
            a.push({
                id: DB.nextId('users'),
                name,
                email,
                role: document.getElementById('usr-role').value,
                status: 'active',
                lastLogin: 'Never'
            });
            DB.set('users', a);
            closeModal('user-modal');
            renderUsers();
            toast('User added', 'success');
        }

        /* ── SETTINGS ── */
        function renderSettings() {
            const co = DB.get('companies')[0] || {};
            document.getElementById('settings-content').innerHTML = `
    <div class="grid-2">
      <div class="card"><div class="card-title"><i class="fa-solid fa-building" style="margin-right:6px;color:var(--accent)"></i>Company Settings</div>
        <div class="form-grid">
          <div class="form-group"><label class="form-label">Company Name</label><input class="form-input" value="${co.name||''}" placeholder="Company name"></div>
          <div class="form-group"><label class="form-label">GST Number</label><input class="form-input" value="${co.gst||''}" placeholder="GST"></div>
          <div class="form-group"><label class="form-label">Financial Year</label><select class="form-select"><option>2024-25</option><option>2025-26</option></select></div>
          <div class="form-group"><label class="form-label">Default GST</label><select class="form-select"><option>18%</option><option>28%</option><option>12%</option></select></div>
        </div>
        <div style="margin-top:14px"><button class="btn btn-primary" onclick="toast('Settings saved','success')"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>
      </div>
      <div class="card"><div class="card-title"><i class="fa-solid fa-file-invoice" style="margin-right:6px;color:var(--accent)"></i>Invoice Settings</div>
        <div class="form-grid">
          <div class="form-group"><label class="form-label">Invoice Prefix</label><input class="form-input" value="INV-2024-"></div>
          <div class="form-group"><label class="form-label">Next Invoice No</label><input class="form-input" value="${DB.get('invoices').length+1}" type="number"></div>
          <div class="form-group"><label class="form-label">Payment Terms (days)</label><input class="form-input" value="30" type="number"></div>
          <div class="form-group"><label class="form-label">Currency</label><select class="form-select"><option>INR (₹)</option><option>USD ($)</option></select></div>
        </div>
        <div style="margin-top:14px"><button class="btn btn-primary" onclick="toast('Invoice settings saved','success')"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>
      </div>
      <div class="card"><div class="card-title"><i class="fa-solid fa-bell" style="margin-right:6px;color:var(--accent)"></i>Notifications</div>
        ${['Low Stock Alerts','Overdue Invoice Alerts','Payment Reminders','GST Filing Reminders'].map(n=>`<div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border)"><span style="font-size:13px">${n}</span><div style="width:42px;height:24px;background:var(--accent);border-radius:99px;cursor:pointer;position:relative;transition:background 0.2s" onclick="this.style.background=this.style.background==''||this.style.background.includes('accent')?'var(--border)':'var(--accent)'"><div style="position:absolute;right:3px;top:3px;width:18px;height:18px;background:#fff;border-radius:50%;box-shadow:0 1px 4px rgba(0,0,0,0.2)"></div></div></div>`).join('')}
        <div style="margin-top:14px"><button class="btn btn-primary" onclick="toast('Notification settings saved','success')"><i class="fa-solid fa-floppy-disk"></i> Save</button></div>
      </div>
      <div class="card"><div class="card-title"><i class="fa-solid fa-database" style="margin-right:6px;color:var(--accent)"></i>Data Management</div>
        <div style="display:flex;flex-direction:column;gap:10px">
          <button class="btn btn-secondary" onclick="toast('Data exported to JSON','success')"><i class="fa-solid fa-file-export"></i> Export All Data (JSON)</button>
          <button class="btn btn-secondary" onclick="toast('Backup created','success')"><i class="fa-solid fa-hard-drive"></i> Create Backup</button>
          <button class="btn btn-danger" onclick="if(confirm('Reset all data? This cannot be undone.')){localStorage.clear();location.reload()}"><i class="fa-solid fa-triangle-exclamation"></i> Reset All Data</button>
        </div>
      </div>
    </div>
  `;
        }

        /* ── DELETE ── */
        function deleteItem(col, id, cb) {
            if (!confirm('Delete this item?')) return;
            let a = DB.get(col);
            a = a.filter(i => i.id !== id);
            DB.set(col, a);
            if (cb) cb();
            toast('Deleted', 'success');
        }

        /* ── INIT ── */
        (function init() {
            seedData();
            // Loader animation
            setTimeout(() => {
                document.getElementById('page-loader').classList.add('hide');
                document.getElementById('app').style.opacity = '1';
                setTimeout(() => document.getElementById('page-loader').remove(), 500);
            }, 1900);
            renderDashboard();
        })();
    </script>
</body>

</html>