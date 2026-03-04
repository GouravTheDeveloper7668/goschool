<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore ERP — School Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"> -->

    <style>
        :root {
            --primary: #1a56db;
            --primary-dark: #1245b8;
            --primary-light: #e8f0fe;
            --accent: #f59e0b;
            --accent-light: #fef3c7;
            --success: #10b981;
            --success-light: #d1fae5;
            --danger: #ef4444;
            --danger-light: #fee2e2;
            --purple: #8b5cf6;
            --purple-light: #ede9fe;
            --teal: #06b6d4;
            --teal-light: #cffafe;
            --sidebar-bg: #0f172a;
            --sidebar-text: #94a3b8;
            --sidebar-active: #1a56db;
            --topbar-bg: #ffffff;
            --body-bg: #f1f5f9;
            --card-bg: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --border: #e2e8f0;
            --shadow: 0 1px 3px rgba(0, 0, 0, .08), 0 4px 16px rgba(0, 0, 0, .06);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, .1);
            --radius: 14px;
            --radius-sm: 8px;
            --transition: all .22s cubic-bezier(.4, 0, .2, 1);
            --sidebar-width: 260px;
            --topbar-height: 68px;
            --font-display: 'Syne', sans-serif;
            --font-body: 'DM Sans', sans-serif;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-body);
            background: var(--body-bg);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ========= LOADER ========= */
        #page-loader {
            position: fixed;
            inset: 0;
            background: #0f172a;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity .5s ease, visibility .5s ease;
        }

        #page-loader.hide {
            opacity: 0;
            visibility: hidden;
        }

        .loader-logo {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 24px;
        }

        .loader-logo span {
            color: var(--accent);
        }

        .loader-bar {
            width: 200px;
            height: 3px;
            background: rgba(255, 255, 255, .15);
            border-radius: 99px;
            overflow: hidden;
        }

        .loader-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 99px;
            animation: loaderFill 2s ease forwards;
        }

        @keyframes loaderFill {
            from {
                width: 0
            }

            to {
                width: 100%
            }
        }

        /* ========= TOASTER ========= */
        #toaster {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 8888;
            display: flex;
            flex-direction: column;
            gap: 8px;
            pointer-events: none;
        }

        .toast-item {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #fff;
            border-radius: var(--radius-sm);
            padding: 14px 18px;
            min-width: 300px;
            max-width: 360px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .15);
            pointer-events: all;
            cursor: pointer;
            transform: translateX(120%);
            opacity: 0;
            transition: transform .35s cubic-bezier(.34, 1.56, .64, 1), opacity .3s ease;
            border-left: 4px solid var(--primary);
        }

        .toast-item.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast-item.toast-success {
            border-color: var(--success);
        }

        .toast-item.toast-danger {
            border-color: var(--danger);
        }

        .toast-item.toast-warning {
            border-color: var(--accent);
        }

        .toast-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            flex-shrink: 0;
        }

        .toast-success .toast-icon {
            background: var(--success-light);
            color: var(--success);
        }

        .toast-danger .toast-icon {
            background: var(--danger-light);
            color: var(--danger);
        }

        .toast-warning .toast-icon {
            background: var(--accent-light);
            color: var(--accent);
        }

        .toast-item .toast-icon {
            background: var(--primary-light);
            color: var(--primary);
        }

        .toast-msg {
            font-size: .88rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .toast-sub {
            font-size: .78rem;
            color: var(--text-secondary);
            margin-top: 2px;
        }

        .toast-close {
            margin-left: auto;
            color: var(--text-secondary);
            font-size: .75rem;
        }

        /* ========= SIDEBAR ========= */
        #sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform .3s cubic-bezier(.4, 0, .2, 1), width .3s ease;
            overflow: hidden;
        }

        #sidebar.collapsed {
            width: 70px;
        }

        #sidebar.mobile-hidden {
            transform: translateX(-100%);
        }

        .sidebar-header {
            padding: 20px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, .06);
            flex-shrink: 0;
        }

        .sidebar-logo-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .sidebar-logo-text {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 800;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            transition: var(--transition);
        }

        .sidebar-logo-text span {
            color: var(--accent);
        }

        #sidebar.collapsed .sidebar-logo-text {
            opacity: 0;
            width: 0;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 14px 10px;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 3px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .1);
            border-radius: 99px;
        }

        .nav-section-label {
            font-size: .67rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: rgba(255, 255, 255, .25);
            padding: 10px 10px 6px;
            white-space: nowrap;
            overflow: hidden;
            transition: var(--transition);
        }

        #sidebar.collapsed .nav-section-label {
            opacity: 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 9px 10px;
            border-radius: var(--radius-sm);
            color: var(--sidebar-text);
            font-size: .875rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            margin-bottom: 2px;
            white-space: nowrap;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, .06);
            color: #fff;
        }

        .nav-item.active {
            background: rgba(26, 86, 219, .25);
            color: #fff;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 20px;
            background: var(--primary);
            border-radius: 0 3px 3px 0;
        }

        .nav-item .nav-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
            flex-shrink: 0;
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }

        .nav-item.active .nav-icon {
            background: rgba(26, 86, 219, .4);
        }

        .nav-item .nav-label {
            overflow: hidden;
            transition: var(--transition);
        }

        #sidebar.collapsed .nav-label {
            opacity: 0;
            width: 0;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--danger);
            color: #fff;
            font-size: .65rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 99px;
            transition: var(--transition);
        }

        #sidebar.collapsed .nav-badge {
            opacity: 0;
        }

        .sidebar-footer {
            padding: 14px 10px;
            border-top: 1px solid rgba(255, 255, 255, .06);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: var(--transition);
        }

        .sidebar-user:hover {
            background: rgba(255, 255, 255, .06);
        }

        .sidebar-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: .8rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .sidebar-user-info {
            overflow: hidden;
            transition: var(--transition);
        }

        #sidebar.collapsed .sidebar-user-info {
            opacity: 0;
            width: 0;
        }

        .sidebar-user-name {
            font-size: .85rem;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
        }

        .sidebar-user-role {
            font-size: .72rem;
            color: var(--sidebar-text);
        }

        /* ========= TOPBAR ========= */
        #topbar {
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);
            height: var(--topbar-height);
            background: var(--topbar-bg);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 24px;
            gap: 16px;
            z-index: 999;
            transition: left .3s ease;
            box-shadow: 0 1px 0 var(--border);
        }

        #sidebar.collapsed~#topbar,
        #sidebar.collapsed~#main-content {
            left: 70px;
        }

        body.sidebar-open #topbar {
            left: var(--sidebar-width);
        }

        .topbar-toggle {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-sm);
            background: none;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            transition: var(--transition);
            flex-shrink: 0;
        }

        .topbar-toggle:hover {
            background: var(--primary-light);
            color: var(--primary);
            border-color: var(--primary);
        }

        .topbar-search {
            flex: 1;
            max-width: 380px;
            position: relative;
        }

        .topbar-search input {
            width: 100%;
            padding: 9px 14px 9px 40px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            background: var(--body-bg);
            font-family: var(--font-body);
            font-size: .875rem;
            color: var(--text-primary);
            outline: none;
            transition: var(--transition);
        }

        .topbar-search input:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(26, 86, 219, .1);
        }

        .topbar-search i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: .85rem;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-left: auto;
        }

        .topbar-btn {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            background: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            transition: var(--transition);
            position: relative;
        }

        .topbar-btn:hover {
            background: var(--primary-light);
            color: var(--primary);
            border-color: var(--primary);
        }

        .topbar-notif-dot {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--danger);
            border: 2px solid #fff;
        }

        .role-switcher {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--body-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 4px;
        }

        .role-btn {
            padding: 5px 10px;
            border-radius: 6px;
            border: none;
            font-family: var(--font-body);
            font-size: .75rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            background: none;
            color: var(--text-secondary);
        }

        .role-btn.active {
            background: var(--primary);
            color: #fff;
        }

        .topbar-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px 6px 6px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: var(--transition);
        }

        .topbar-profile:hover {
            background: var(--body-bg);
        }

        .topbar-profile-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), #6366f1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: .75rem;
            font-weight: 700;
        }

        .topbar-profile-name {
            font-size: .84rem;
            font-weight: 600;
            line-height: 1.2;
        }

        .topbar-profile-role {
            font-size: .72rem;
            color: var(--text-secondary);
        }

        /* ========= MAIN CONTENT ========= */
        #main-content {
            position: fixed;
            top: var(--topbar-height);
            left: var(--sidebar-width);
            right: 0;
            bottom: 0;
            overflow-y: auto;
            transition: left .3s ease;
            background: var(--body-bg);
        }

        #main-content::-webkit-scrollbar {
            width: 6px;
        }

        #main-content::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 99px;
        }

        .content-inner {
            padding: 28px;
            /* max-width: 1600px; */
        }

        /* ========= VIEWS ========= */
        .view {
            display: none;
        }

        .view.active {
            display: block;
            animation: fadeUp .3s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(12px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        /* ========= PAGE HEADER ========= */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-title {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 800;
        }

        .page-subtitle {
            font-size: .85rem;
            color: var(--text-secondary);
            margin-top: 2px;
        }

        .page-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* ========= BUTTONS ========= */
        .btn-primary-custom {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 9px 18px;
            border-radius: var(--radius-sm);
            font-family: var(--font-body);
            font-size: .875rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .btn-primary-custom:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(26, 86, 219, .3);
        }

        .btn-outline-custom {
            background: none;
            color: var(--text-primary);
            border: 1px solid var(--border);
            padding: 9px 18px;
            border-radius: var(--radius-sm);
            font-family: var(--font-body);
            font-size: .875rem;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .btn-outline-custom:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        /* ========= STAT CARDS ========= */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 22px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            display: flex;
            align-items: flex-start;
            gap: 16px;
            transition: var(--transition);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
        }

        .stat-card.blue::before {
            background: linear-gradient(90deg, var(--primary), #3b82f6);
        }

        .stat-card.green::before {
            background: linear-gradient(90deg, var(--success), #34d399);
        }

        .stat-card.orange::before {
            background: linear-gradient(90deg, var(--accent), #fbbf24);
        }

        .stat-card.purple::before {
            background: linear-gradient(90deg, var(--purple), #a78bfa);
        }

        .stat-card.teal::before {
            background: linear-gradient(90deg, var(--teal), #22d3ee);
        }

        .stat-card.red::before {
            background: linear-gradient(90deg, var(--danger), #f87171);
        }

        .stat-card.pink::before {
            background: linear-gradient(90deg, #ec4899, #f472b6);
        }

        .stat-card.indigo::before {
            background: linear-gradient(90deg, #6366f1, #818cf8);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .stat-card.blue .stat-icon {
            background: var(--primary-light);
            color: var(--primary);
        }

        .stat-card.green .stat-icon {
            background: var(--success-light);
            color: var(--success);
        }

        .stat-card.orange .stat-icon {
            background: var(--accent-light);
            color: var(--accent);
        }

        .stat-card.purple .stat-icon {
            background: var(--purple-light);
            color: var(--purple);
        }

        .stat-card.teal .stat-icon {
            background: var(--teal-light);
            color: var(--teal);
        }

        .stat-card.red .stat-icon {
            background: var(--danger-light);
            color: var(--danger);
        }

        .stat-card.pink .stat-icon {
            background: #fce7f3;
            color: #ec4899;
        }

        .stat-card.indigo .stat-icon {
            background: #e0e7ff;
            color: #6366f1;
        }

        .stat-info {
            flex: 1;
        }

        .stat-value {
            font-family: var(--font-display);
            font-size: 1.75rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: .82rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .stat-change {
            font-size: .75rem;
            margin-top: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-change.up {
            color: var(--success);
        }

        .stat-change.down {
            color: var(--danger);
        }

        /* ========= DASHBOARD GRID ========= */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 340px;
            gap: 20px;
        }

        .span-2 {
            grid-column: span 2;
        }

        .span-full {
            grid-column: 1 / -1;
        }

        /* ========= CARDS ========= */
        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .card-header {
            padding: 18px 20px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .card-title {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
        }

        .card-subtitle {
            font-size: .78rem;
            color: var(--text-secondary);
            margin-top: 2px;
        }

        .card-body {
            padding: 0 20px 20px;
        }

        .card-body-full {
            padding: 0 20px 20px;
        }

        /* ========= CALENDAR ========= */
        .calendar-widget {
            padding: 18px 20px 20px;
        }

        .calendar-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .calendar-month {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
        }

        .cal-btn {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            transition: var(--transition);
            font-size: .8rem;
        }

        .cal-btn:hover {
            background: var(--primary-light);
            color: var(--primary);
        }

        .cal-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
        }

        .cal-day-label {
            text-align: center;
            font-size: .7rem;
            font-weight: 700;
            color: var(--text-secondary);
            padding: 4px 0;
            text-transform: uppercase;
        }

        .cal-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-size: .8rem;
            cursor: pointer;
            transition: var(--transition);
            color: var(--text-secondary);
        }

        .cal-day:hover {
            background: var(--primary-light);
            color: var(--primary);
        }

        .cal-day.today {
            background: var(--primary);
            color: #fff;
            font-weight: 700;
        }

        .cal-day.has-event {
            position: relative;
            color: var(--text-primary);
            font-weight: 600;
        }

        .cal-day.has-event::after {
            content: '';
            position: absolute;
            bottom: 3px;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--accent);
        }

        .cal-day.other-month {
            opacity: .3;
        }

        /* ========= NOTICES ========= */
        .notice-item {
            display: flex;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
        }

        .notice-item:last-child {
            border-bottom: none;
        }

        .notice-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-top: 6px;
            flex-shrink: 0;
        }

        .notice-content {}

        .notice-title {
            font-size: .875rem;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .notice-date {
            font-size: .75rem;
            color: var(--text-secondary);
        }

        .notice-tag {
            display: inline-flex;
            align-items: center;
            font-size: .68rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 99px;
            margin-left: 8px;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        /* ========= ANNOUNCEMENT BANNER ========= */
        .announcement-banner {
            background: linear-gradient(135deg, var(--primary), #4f46e5);
            border-radius: var(--radius);
            padding: 20px 24px;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .announcement-banner::before {
            content: '';
            position: absolute;
            right: -20px;
            top: -20px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .07);
        }

        .announcement-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(255, 255, 255, .15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .announcement-text {
            flex: 1;
        }

        .announcement-text h3 {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .announcement-text p {
            font-size: .82rem;
            opacity: .85;
        }

        .announcement-badge {
            background: rgba(255, 255, 255, .2);
            padding: 4px 10px;
            border-radius: 99px;
            font-size: .75rem;
            font-weight: 700;
        }

        /* ========= TABLE ========= */
        .table-custom {
            width: 100%;
            border-collapse: collapse;
            font-size: .875rem;
        }

        .table-custom th {
            padding: 10px 14px;
            background: var(--body-bg);
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--text-secondary);
            border-bottom: 1px solid var(--border);
            text-align: left;
        }

        .table-custom td {
            padding: 12px 14px;
            border-bottom: 1px solid rgba(226, 232, 240, .5);
            vertical-align: middle;
        }

        .table-custom tr:last-child td {
            border-bottom: none;
        }

        .table-custom tr:hover td {
            background: var(--body-bg);
        }

        .badge-custom {
            display: inline-flex;
            align-items: center;
            font-size: .72rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 99px;
        }

        .badge-active {
            background: var(--success-light);
            color: var(--success);
        }

        .badge-inactive {
            background: var(--danger-light);
            color: var(--danger);
        }

        .badge-pending {
            background: var(--accent-light);
            color: var(--accent);
        }

        .badge-paid {
            background: var(--success-light);
            color: var(--success);
        }

        .badge-unpaid {
            background: var(--danger-light);
            color: var(--danger);
        }

        .badge-partial {
            background: var(--purple-light);
            color: var(--purple);
        }

        .badge-primary {
            background: var(--primary-light);
            color: var(--primary);
        }

        .avatar-sm {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--purple));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: .72rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* ========= QUICK ACTIONS ========= */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .qa-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 16px 8px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            background: var(--card-bg);
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
        }

        .qa-btn:hover {
            background: var(--primary-light);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .qa-btn:hover .qa-icon {
            background: var(--primary);
            color: #fff;
        }

        .qa-icon {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-sm);
            background: var(--body-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .9rem;
            color: var(--text-secondary);
            transition: var(--transition);
        }

        .qa-label {
            font-size: .75rem;
            font-weight: 600;
            color: var(--text-secondary);
            transition: var(--transition);
        }

        .qa-btn:hover .qa-label {
            color: var(--primary);
        }

        /* ========= PROGRESS BAR ========= */
        .progress-custom {
            height: 6px;
            border-radius: 99px;
            background: var(--body-bg);
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 99px;
            transition: width 1s ease;
        }

        /* ========= ACTIVITY FEED ========= */
        .activity-item {
            display: flex;
            gap: 12px;
            padding: 10px 0;
        }

        .activity-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .activity-text {
            font-size: .85rem;
            line-height: 1.4;
        }

        .activity-time {
            font-size: .72rem;
            color: var(--text-secondary);
            margin-top: 2px;
        }

        /* ========= PROFILE ========= */
        .profile-banner {
            background: linear-gradient(135deg, #1a56db 0%, #4f46e5 50%, #7c3aed 100%);
            height: 180px;
            border-radius: var(--radius) var(--radius) 0 0;
            position: relative;
        }

        .profile-avatar-wrap {
            position: absolute;
            bottom: -44px;
            left: 32px;
            width: 88px;
            height: 88px;
            border-radius: 50%;
            border: 4px solid #fff;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-size: 1.75rem;
            font-weight: 800;
            color: #fff;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .2);
        }

        .profile-actions {
            position: absolute;
            bottom: -20px;
            right: 24px;
            display: flex;
            gap: 8px;
        }

        .profile-info {
            padding: 60px 32px 24px;
        }

        .profile-name {
            font-family: var(--font-display);
            font-size: 1.6rem;
            font-weight: 800;
        }

        .profile-meta {
            color: var(--text-secondary);
            font-size: .875rem;
            margin-top: 4px;
        }

        .profile-stats-row {
            display: flex;
            gap: 32px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .profile-stat {
            text-align: center;
        }

        .profile-stat-val {
            font-family: var(--font-display);
            font-size: 1.4rem;
            font-weight: 800;
        }

        .profile-stat-label {
            font-size: .75rem;
            color: var(--text-secondary);
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 24px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-size: .82rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .info-value {
            font-size: .875rem;
            font-weight: 600;
        }

        /* ========= FORM STYLES ========= */
        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            font-size: .82rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 6px;
            display: block;
        }

        .form-control-custom {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: var(--font-body);
            font-size: .875rem;
            color: var(--text-primary);
            background: var(--body-bg);
            outline: none;
            transition: var(--transition);
        }

        .form-control-custom:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(26, 86, 219, .1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        /* ========= SUBMENU ========= */
        .nav-item-parent {
            cursor: pointer;
        }

        .nav-item-parent .nav-arrow {
            margin-left: auto;
            font-size: .65rem;
            transition: transform .25s ease;
            color: var(--sidebar-text);
        }

        .nav-item-parent.open .nav-arrow {
            transform: rotate(90deg);
        }

        .submenu {
            overflow: hidden;
            max-height: 0;
            transition: max-height .3s cubic-bezier(.4, 0, .2, 1);
            padding-left: 16px;
        }

        .submenu.open {
            max-height: 300px;
        }

        .submenu-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 7px 10px 7px 14px;
            border-radius: var(--radius-sm);
            color: var(--sidebar-text);
            font-size: .82rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 1px;
            border-left: 2px solid rgba(255, 255, 255, .08);
        }

        .submenu-item:hover {
            background: rgba(255, 255, 255, .05);
            color: #fff;
            border-color: rgba(26, 86, 219, .5);
        }

        .submenu-item.active {
            background: rgba(26, 86, 219, .15);
            color: #a5b4fc;
            border-color: var(--primary);
        }

        .submenu-item i {
            width: 16px;
            text-align: center;
            font-size: .78rem;
        }

        #sidebar.collapsed .submenu {
            display: none;
        }

        /* ========= MARKSHEET PRINT TEMPLATE ========= */
        .marksheet-template {
            background: #fff;
            border: 2px solid #1a56db;
            border-radius: var(--radius);
            overflow: hidden;
            font-family: 'DM Sans', sans-serif;
        }

        .ms-header {
            background: linear-gradient(135deg, #1a56db, #4f46e5);
            color: #fff;
            padding: 20px 28px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .ms-school-logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 800;
            border: 2px solid rgba(255, 255, 255, .4);
        }

        .ms-school-name {
            font-size: 1.2rem;
            font-weight: 800;
            font-family: var(--font-display);
        }

        .ms-school-sub {
            font-size: .78rem;
            opacity: .8;
        }

        .ms-title-bar {
            background: #f8faff;
            border-bottom: 1px solid #dbeafe;
            padding: 10px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ms-title {
            font-weight: 800;
            font-size: .95rem;
            color: var(--primary);
            font-family: var(--font-display);
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .ms-info-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
            padding: 16px 28px;
            background: #fff;
            border-bottom: 1px solid var(--border);
        }

        .ms-info-box {
            padding: 10px 14px;
            background: var(--body-bg);
            border-radius: var(--radius-sm);
            border-left: 3px solid var(--primary);
        }

        .ms-info-label {
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--text-secondary);
        }

        .ms-info-value {
            font-size: .9rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-top: 2px;
        }

        .ms-table {
            width: 100%;
            border-collapse: collapse;
        }

        .ms-table th {
            background: #eff6ff;
            padding: 10px 16px;
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--primary);
            border: 1px solid #dbeafe;
            text-align: center;
        }

        .ms-table td {
            padding: 10px 16px;
            border: 1px solid #e2e8f0;
            text-align: center;
            font-size: .85rem;
        }

        .ms-table tr:nth-child(even) td {
            background: #f8faff;
        }

        .ms-table td:nth-child(2) {
            text-align: left;
            font-weight: 600;
        }

        .ms-grade-a {
            color: #10b981;
            font-weight: 800;
        }

        .ms-grade-b {
            color: #3b82f6;
            font-weight: 800;
        }

        .ms-grade-c {
            color: #f59e0b;
            font-weight: 800;
        }

        .ms-grade-d {
            color: #ef4444;
            font-weight: 800;
        }

        .ms-footer-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
            padding: 16px 28px;
            border-top: 2px solid #dbeafe;
            background: #eff6ff;
        }

        .ms-sign-box {
            text-align: center;
            padding-top: 24px;
            border-top: 1px solid #94a3b8;
            font-size: .75rem;
            color: var(--text-secondary);
            font-weight: 600;
        }

        .ms-result-banner {
            text-align: center;
            padding: 12px;
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 800;
        }

        .ms-result-banner.pass {
            background: var(--success-light);
            color: var(--success);
        }

        .ms-result-banner.fail {
            background: var(--danger-light);
            color: var(--danger);
        }

        /* ========= ATTENDANCE ========= */
        .att-status-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 2px solid var(--border);
            font-size: .7rem;
            font-weight: 800;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }

        .att-status-btn.present {
            background: var(--success);
            border-color: var(--success);
            color: #fff;
        }

        .att-status-btn.absent {
            background: var(--danger);
            border-color: var(--danger);
            color: #fff;
        }

        .att-status-btn.late {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        .att-summary-bar {
            display: flex;
            gap: 16px;
            padding: 14px 20px;
            background: var(--body-bg);
            border-radius: var(--radius-sm);
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .att-sum-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .85rem;
            font-weight: 600;
        }

        .att-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* ========= FEE CREATE FORM ========= */
        .fee-form-section {
            background: var(--body-bg);
            border-radius: var(--radius-sm);
            padding: 18px;
            margin-bottom: 16px;
            border: 1px solid var(--border);
        }

        .fee-form-section-title {
            font-size: .82rem;
            font-weight: 700;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .fee-item-row {
            display: grid;
            grid-template-columns: 1fr 140px 120px 40px;
            gap: 10px;
            align-items: end;
            margin-bottom: 10px;
        }

        .fee-total-box {
            background: linear-gradient(135deg, var(--primary), #4f46e5);
            color: #fff;
            border-radius: var(--radius-sm);
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .fee-total-label {
            font-size: .85rem;
            opacity: .85;
        }

        .fee-total-amount {
            font-family: var(--font-display);
            font-size: 1.6rem;
            font-weight: 800;
        }

        /* ========= SIDEBAR OVERLAY ========= */
        #sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 999;
        }

        #sidebar-overlay.show {
            display: block;
        }

        /* ========= SCROLLBAR ========= */
        .scroll-area {
            overflow-y: auto;
            max-height: 320px;
        }

        .scroll-area::-webkit-scrollbar {
            width: 4px;
        }

        .scroll-area::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 99px;
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 1300px) {
            .dashboard-grid {
                grid-template-columns: 1fr 1fr;
            }

            .span-2 {
                grid-column: span 2;
            }
        }

        @media (max-width: 1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 991px) {
            #sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width) !important;
            }

            #sidebar.mobile-open {
                transform: translateX(0);
            }

            #topbar,
            #main-content {
                left: 0 !important;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .span-2 {
                grid-column: span 1;
            }

            .content-inner {
                padding: 16px;
            }

            .quick-actions {
                grid-template-columns: repeat(4, 1fr);
            }

            .profile-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .topbar-search {
                display: none;
            }

            .role-switcher {
                display: none;
            }

            .topbar-profile-name,
            .topbar-profile-role {
                display: none;
            }

            .content-inner {
                padding: 12px;
            }

            .quick-actions {
                grid-template-columns: repeat(4, 1fr);
            }

            .page-header {
                margin-bottom: 16px;
            }
        }

        @media (max-width: 420px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>

    <!-- PAGE LOADER -->
    <div id="page-loader">
        <div class="loader-logo">Edu<span>Core</span></div>
        <div class="loader-bar">
            <div class="loader-bar-fill"></div>
        </div>
        <p style="color:rgba(255,255,255,.4);font-size:.8rem;margin-top:12px">Loading your workspace…</p>
    </div>

    <!-- TOASTER -->
    <div id="toaster"></div>

    <!-- SIDEBAR OVERLAY -->
    <div id="sidebar-overlay" onclick="closeMobileSidebar()"></div>

    <!-- SIDEBAR -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo-icon"><i class="fas fa-graduation-cap"></i></div>
            <div class="sidebar-logo-text">Edu<span>Core</span></div>
        </div>

        <div class="sidebar-nav">
            <div class="nav-section-label">Overview</div>
            <a class="nav-item active" onclick="showView('dashboard')">
                <div class="nav-icon"><i class="fas fa-th-large"></i></div>
                <span class="nav-label">Dashboard</span>
            </a>

            <div class="nav-section-label">Academics</div>
            <a class="nav-item" onclick="showView('students')">
                <div class="nav-icon"><i class="fas fa-user-graduate"></i></div>
                <span class="nav-label">Students</span>
                <span class="nav-badge">248</span>
            </a>
            <a class="nav-item" onclick="showView('teachers')">
                <div class="nav-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <span class="nav-label">Teachers</span>
            </a>
            <a class="nav-item" onclick="showView('classes')">
                <div class="nav-icon"><i class="fas fa-school"></i></div>
                <span class="nav-label">Classes</span>
            </a>
            <a class="nav-item" onclick="showView('subjects')">
                <div class="nav-icon"><i class="fas fa-book-open"></i></div>
                <span class="nav-label">Subjects</span>
            </a>
            <!-- Marksheet with submenu -->
            <a class="nav-item nav-item-parent" onclick="toggleSubmenu('sub-marksheet',this)">
                <div class="nav-icon"><i class="fas fa-file-alt"></i></div>
                <span class="nav-label">Marksheets</span>
                <i class="fas fa-chevron-right nav-arrow"></i>
            </a>
            <div class="submenu" id="sub-marksheet">
                <div class="submenu-item" onclick="showView('marksheet')"><i class="fas fa-list-ol"></i> Result List</div>
                <div class="submenu-item" onclick="showView('marksheet-template')"><i class="fas fa-palette"></i> Templates</div>
                <div class="submenu-item" onclick="showView('marksheet-demo')"><i class="fas fa-eye"></i> Preview Demo</div>
            </div>

            <!-- Attendance with submenu -->
            <a class="nav-item nav-item-parent" onclick="toggleSubmenu('sub-attendance',this)">
                <div class="nav-icon"><i class="fas fa-calendar-check"></i></div>
                <span class="nav-label">Attendance</span>
                <i class="fas fa-chevron-right nav-arrow"></i>
            </a>
            <div class="submenu" id="sub-attendance">
                <div class="submenu-item" onclick="showView('attendance')"><i class="fas fa-clipboard-check"></i> Take Attendance</div>
                <div class="submenu-item" onclick="showToast('info','Report','Attendance report loading…')"><i class="fas fa-chart-bar"></i> Attendance Report</div>
            </div>

            <div class="nav-section-label">Finance</div>
            <!-- Fee with submenu -->
            <a class="nav-item nav-item-parent" onclick="toggleSubmenu('sub-fees',this)">
                <div class="nav-icon"><i class="fas fa-coins"></i></div>
                <span class="nav-label">Fee Management</span>
                <span class="nav-badge" style="background:var(--accent);color:#fff">5</span>
            </a>
            <div class="submenu" id="sub-fees">
                <div class="submenu-item" onclick="showView('fees')"><i class="fas fa-list"></i> Fee Records</div>
                <div class="submenu-item" onclick="showView('fee-create')"><i class="fas fa-plus-circle"></i> Create Fee</div>
                <div class="submenu-item" onclick="showToast('info','Reminder','Sending reminders…')"><i class="fas fa-bell"></i> Send Reminder</div>
            </div>
            <a class="nav-item" onclick="showView('invoices')">
                <div class="nav-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                <span class="nav-label">Invoices</span>
            </a>

            <div class="nav-section-label">Account</div>
            <a class="nav-item" onclick="showView('profile')">
                <div class="nav-icon"><i class="fas fa-user-circle"></i></div>
                <span class="nav-label">Profile</span>
            </a>
            <a class="nav-item">
                <div class="nav-icon"><i class="fas fa-cog"></i></div>
                <span class="nav-label">Settings</span>
            </a>
        </div>

        <div class="sidebar-footer">
            <div class="sidebar-user" onclick="showView('profile')">
                <div class="sidebar-avatar">AD</div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">Admin User</div>
                    <div class="sidebar-user-role">Super Administrator</div>
                </div>
            </div>
        </div>
    </nav>

    <!-- TOPBAR -->
    <header id="topbar">
        <button class="topbar-toggle" id="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>

        <div class="topbar-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search students, classes, invoices…">
        </div>

        <div class="topbar-actions">
            <div class="role-switcher">
                <button class="role-btn active" onclick="switchRole('admin',this)">Admin</button>
                <button class="role-btn" onclick="switchRole('teacher',this)">Teacher</button>
                <button class="role-btn" onclick="switchRole('student',this)">Student</button>
            </div>
            <button class="topbar-btn" onclick="showToast('info','Notifications','You have 3 new notifications')">
                <i class="fas fa-bell"></i>
                <span class="topbar-notif-dot"></span>
            </button>
            <button class="topbar-btn" onclick="showToast('info','Messages','2 unread messages')">
                <i class="fas fa-envelope"></i>
            </button>
            <div class="topbar-profile" onclick="showView('profile')">
                <div class="topbar-profile-avatar">AD</div>
                <div>
                    <div class="topbar-profile-name">Admin User</div>
                    <div class="topbar-profile-role">Super Admin</div>
                </div>
                <i class="fas fa-chevron-down" style="color:var(--text-secondary);font-size:.7rem;margin-left:4px"></i>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main id="main-content">
        <div class="content-inner">

            <!-- ===================== DASHBOARD VIEW ===================== -->
            <div class="view active" id="view-dashboard">

                <!-- Announcement -->
                <div class="announcement-banner">
                    <div class="announcement-icon"><i class="fas fa-bullhorn"></i></div>
                    <div class="announcement-text">
                        <h3>Annual Examination Schedule Released!</h3>
                        <p>Final exams start from April 15, 2025. Check the schedule in the notice board.</p>
                    </div>
                    <span class="announcement-badge"><i class="fas fa-calendar-alt me-1"></i>April 15</span>
                </div>

                <!-- Stats -->
                <div class="stats-grid">
                    <div class="stat-card blue" onclick="showView('students')">
                        <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">1,248</div>
                            <div class="stat-label">Total Students</div>
                            <div class="stat-change up"><i class="fas fa-arrow-up"></i> +12% this month</div>
                        </div>
                    </div>
                    <div class="stat-card green" onclick="showView('teachers')">
                        <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">86</div>
                            <div class="stat-label">Total Teachers</div>
                            <div class="stat-change up"><i class="fas fa-arrow-up"></i> +3 new</div>
                        </div>
                    </div>
                    <div class="stat-card orange" onclick="showView('classes')">
                        <div class="stat-icon"><i class="fas fa-school"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">42</div>
                            <div class="stat-label">Active Classes</div>
                            <div class="stat-change up"><i class="fas fa-arrow-up"></i> 100% active</div>
                        </div>
                    </div>
                    <div class="stat-card purple" onclick="showView('fees')">
                        <div class="stat-icon"><i class="fas fa-rupee-sign"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">₹8.4L</div>
                            <div class="stat-label">Fee Collected</div>
                            <div class="stat-change down"><i class="fas fa-arrow-down"></i> 5 pending</div>
                        </div>
                    </div>
                </div>

                <!-- Second row stats -->
                <div class="stats-grid" style="margin-bottom:24px">
                    <div class="stat-card teal" onclick="showView('subjects')">
                        <div class="stat-icon"><i class="fas fa-book-open"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">24</div>
                            <div class="stat-label">Subjects Offered</div>
                            <div class="stat-change up"><i class="fas fa-arrow-up"></i> 2 added</div>
                        </div>
                    </div>
                    <div class="stat-card red" onclick="showView('marksheet')">
                        <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">98.2%</div>
                            <div class="stat-label">Pass Rate</div>
                            <div class="stat-change up"><i class="fas fa-arrow-up"></i> +2.1% vs last term</div>
                        </div>
                    </div>
                    <div class="stat-card pink" onclick="showView('invoices')">
                        <div class="stat-icon"><i class="fas fa-file-invoice"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">312</div>
                            <div class="stat-label">Invoices Issued</div>
                            <div class="stat-change up"><i class="fas fa-arrow-up"></i> +18 this week</div>
                        </div>
                    </div>
                    <div class="stat-card indigo">
                        <div class="stat-icon"><i class="fas fa-percentage"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">91%</div>
                            <div class="stat-label">Avg Attendance</div>
                            <div class="stat-change down"><i class="fas fa-arrow-down"></i> -1.2% vs last week</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card" style="margin-bottom:20px">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Quick Actions</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="quick-actions">
                            <div class="qa-btn" onclick="showView('students');showToast('success','Navigation','Opening student registration')">
                                <div class="qa-icon"><i class="fas fa-user-plus"></i></div>
                                <div class="qa-label">Add Student</div>
                            </div>
                            <div class="qa-btn" onclick="showView('teachers');showToast('success','Navigation','Opening teacher management')">
                                <div class="qa-icon"><i class="fas fa-user-tie"></i></div>
                                <div class="qa-label">Add Teacher</div>
                            </div>
                            <div class="qa-btn" onclick="showView('fees');showToast('info','Fee','Opening fee collection')">
                                <div class="qa-icon"><i class="fas fa-hand-holding-usd"></i></div>
                                <div class="qa-label">Collect Fee</div>
                            </div>
                            <div class="qa-btn" onclick="showView('marksheet');showToast('info','Marksheet','Opening result entry')">
                                <div class="qa-icon"><i class="fas fa-pen-alt"></i></div>
                                <div class="qa-label">Enter Result</div>
                            </div>
                            <div class="qa-btn" onclick="showView('invoices');showToast('success','Invoice','Creating new invoice')">
                                <div class="qa-icon"><i class="fas fa-file-invoice"></i></div>
                                <div class="qa-label">New Invoice</div>
                            </div>
                            <div class="qa-btn" onclick="showToast('info','Report','Generating attendance report…')">
                                <div class="qa-icon"><i class="fas fa-chart-bar"></i></div>
                                <div class="qa-label">Attendance</div>
                            </div>
                            <div class="qa-btn" onclick="showToast('info','Schedule','Opening timetable')">
                                <div class="qa-icon"><i class="fas fa-calendar-alt"></i></div>
                                <div class="qa-label">Timetable</div>
                            </div>
                            <div class="qa-btn" onclick="showToast('info','Exams','Exam schedule loading…')">
                                <div class="qa-icon"><i class="fas fa-clipboard-list"></i></div>
                                <div class="qa-label">Exam Sched.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Dashboard Grid -->
                <div class="dashboard-grid">

                    <!-- Recent Students -->
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Recent Admissions</div>
                                <div class="card-subtitle">Newly enrolled students</div>
                            </div>
                            <button class="btn-outline-custom" style="padding:6px 12px;font-size:.78rem" onclick="showView('students')">View All</button>
                        </div>
                        <div class="card-body-full">
                            <table class="table-custom">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Class</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:8px">
                                                <div class="avatar-sm" style="background:linear-gradient(135deg,#3b82f6,#6366f1)">AS</div>
                                                <div>
                                                    <div style="font-weight:600;font-size:.85rem">Arjun Sharma</div>
                                                    <div style="font-size:.72rem;color:var(--text-secondary)">#STU-1248</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>10-A</td>
                                        <td style="font-size:.8rem;color:var(--text-secondary)">Mar 2</td>
                                        <td><span class="badge-custom badge-active">Active</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:8px">
                                                <div class="avatar-sm" style="background:linear-gradient(135deg,#ec4899,#f59e0b)">PG</div>
                                                <div>
                                                    <div style="font-weight:600;font-size:.85rem">Priya Gupta</div>
                                                    <div style="font-size:.72rem;color:var(--text-secondary)">#STU-1247</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>9-B</td>
                                        <td style="font-size:.8rem;color:var(--text-secondary)">Mar 1</td>
                                        <td><span class="badge-custom badge-active">Active</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:8px">
                                                <div class="avatar-sm" style="background:linear-gradient(135deg,#10b981,#06b6d4)">RK</div>
                                                <div>
                                                    <div style="font-weight:600;font-size:.85rem">Rahul Kumar</div>
                                                    <div style="font-size:.72rem;color:var(--text-secondary)">#STU-1246</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>11-C</td>
                                        <td style="font-size:.8rem;color:var(--text-secondary)">Feb 28</td>
                                        <td><span class="badge-custom badge-pending">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:8px">
                                                <div class="avatar-sm" style="background:linear-gradient(135deg,#8b5cf6,#ec4899)">SD</div>
                                                <div>
                                                    <div style="font-weight:600;font-size:.85rem">Sneha Das</div>
                                                    <div style="font-size:.72rem;color:var(--text-secondary)">#STU-1245</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>8-A</td>
                                        <td style="font-size:.8rem;color:var(--text-secondary)">Feb 27</td>
                                        <td><span class="badge-custom badge-active">Active</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:8px">
                                                <div class="avatar-sm" style="background:linear-gradient(135deg,#f59e0b,#ef4444)">MR</div>
                                                <div>
                                                    <div style="font-weight:600;font-size:.85rem">Mohammed Rafi</div>
                                                    <div style="font-size:.72rem;color:var(--text-secondary)">#STU-1244</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12-B</td>
                                        <td style="font-size:.8rem;color:var(--text-secondary)">Feb 26</td>
                                        <td><span class="badge-custom badge-active">Active</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Fee Overview -->
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Fee Collection</div>
                                <div class="card-subtitle">Current month overview</div>
                            </div>
                            <button class="btn-outline-custom" style="padding:6px 12px;font-size:.78rem" onclick="showView('fees')">Details</button>
                        </div>
                        <div class="card-body">
                            <div style="margin-bottom:16px">
                                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
                                    <span style="font-size:.82rem;font-weight:600">Tuition Fee</span>
                                    <span style="font-size:.82rem;color:var(--text-secondary)">₹3.2L / ₹4L</span>
                                </div>
                                <div class="progress-custom">
                                    <div class="progress-fill" style="width:80%;background:linear-gradient(90deg,var(--primary),#3b82f6)"></div>
                                </div>
                            </div>
                            <div style="margin-bottom:16px">
                                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
                                    <span style="font-size:.82rem;font-weight:600">Transport Fee</span>
                                    <span style="font-size:.82rem;color:var(--text-secondary)">₹85K / ₹1.2L</span>
                                </div>
                                <div class="progress-custom">
                                    <div class="progress-fill" style="width:71%;background:linear-gradient(90deg,var(--success),#34d399)"></div>
                                </div>
                            </div>
                            <div style="margin-bottom:16px">
                                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
                                    <span style="font-size:.82rem;font-weight:600">Library Fee</span>
                                    <span style="font-size:.82rem;color:var(--text-secondary)">₹42K / ₹50K</span>
                                </div>
                                <div class="progress-custom">
                                    <div class="progress-fill" style="width:84%;background:linear-gradient(90deg,var(--accent),#fbbf24)"></div>
                                </div>
                            </div>
                            <div>
                                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
                                    <span style="font-size:.82rem;font-weight:600">Exam Fee</span>
                                    <span style="font-size:.82rem;color:var(--text-secondary)">₹28K / ₹60K</span>
                                </div>
                                <div class="progress-custom">
                                    <div class="progress-fill" style="width:47%;background:linear-gradient(90deg,var(--purple),#a78bfa)"></div>
                                </div>
                            </div>
                            <div style="margin-top:20px;padding:14px;background:var(--body-bg);border-radius:var(--radius-sm);display:flex;justify-content:space-between;align-items:center">
                                <div>
                                    <div style="font-size:.78rem;color:var(--text-secondary)">Total Collected</div>
                                    <div style="font-family:var(--font-display);font-size:1.2rem;font-weight:800;color:var(--success)">₹8,42,000</div>
                                </div>
                                <div>
                                    <div style="font-size:.78rem;color:var(--text-secondary)">Pending</div>
                                    <div style="font-family:var(--font-display);font-size:1.2rem;font-weight:800;color:var(--danger)">₹1,88,000</div>
                                </div>
                                <div>
                                    <div style="font-size:.78rem;color:var(--text-secondary)">Collection %</div>
                                    <div style="font-family:var(--font-display);font-size:1.2rem;font-weight:800;color:var(--primary)">81.7%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right column: Calendar + Notices -->
                    <div style="display:flex;flex-direction:column;gap:20px">

                        <!-- Calendar -->
                        <div class="card">
                            <div class="calendar-widget" id="cal-widget"></div>
                        </div>

                        <!-- Notices -->
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <div class="card-title">Notices</div>
                                </div>
                                <button class="btn-outline-custom" style="padding:4px 10px;font-size:.75rem">+ Add</button>
                            </div>
                            <div class="card-body">
                                <div class="notice-item">
                                    <div class="notice-dot" style="background:var(--danger)"></div>
                                    <div class="notice-content">
                                        <div class="notice-title">Annual Sports Day — April 20 <span class="notice-tag" style="background:var(--danger-light);color:var(--danger)">Urgent</span></div>
                                        <div class="notice-date">Posted: Mar 3, 2025</div>
                                    </div>
                                </div>
                                <div class="notice-item">
                                    <div class="notice-dot" style="background:var(--primary)"></div>
                                    <div class="notice-content">
                                        <div class="notice-title">Parent-Teacher Meeting — Mar 15 <span class="notice-tag" style="background:var(--primary-light);color:var(--primary)">Event</span></div>
                                        <div class="notice-date">Posted: Mar 1, 2025</div>
                                    </div>
                                </div>
                                <div class="notice-item">
                                    <div class="notice-dot" style="background:var(--success)"></div>
                                    <div class="notice-content">
                                        <div class="notice-title">Holiday: Holi — Mar 14</div>
                                        <div class="notice-date">Posted: Feb 28, 2025</div>
                                    </div>
                                </div>
                                <div class="notice-item">
                                    <div class="notice-dot" style="background:var(--accent)"></div>
                                    <div class="notice-content">
                                        <div class="notice-title">Fee Submission Deadline — Mar 20</div>
                                        <div class="notice-date">Posted: Feb 25, 2025</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Activity Feed -->
                <div class="card" style="margin-top:20px">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Recent Activity</div>
                            <div class="card-subtitle">System-wide activity log</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:0">
                            <div class="activity-item">
                                <div class="activity-avatar" style="background:linear-gradient(135deg,var(--primary),#3b82f6)">AS</div>
                                <div>
                                    <div class="activity-text"><strong>Arjun Sharma</strong> enrolled in Class 10-A</div>
                                    <div class="activity-time">2 hours ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-avatar" style="background:linear-gradient(135deg,var(--success),#34d399)">PM</div>
                                <div>
                                    <div class="activity-text"><strong>₹12,500</strong> fee collected from Priya Mehta</div>
                                    <div class="activity-time">3 hours ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-avatar" style="background:linear-gradient(135deg,var(--accent),#fbbf24)">AK</div>
                                <div>
                                    <div class="activity-text"><strong>Anil Kumar</strong> (Teacher) updated marksheet for 10-B</div>
                                    <div class="activity-time">5 hours ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-avatar" style="background:linear-gradient(135deg,var(--purple),#a78bfa)">RJ</div>
                                <div>
                                    <div class="activity-text">Invoice <strong>#INV-312</strong> generated for Rahul Joshi</div>
                                    <div class="activity-time">Yesterday</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-avatar" style="background:linear-gradient(135deg,var(--teal),#22d3ee)">SP</div>
                                <div>
                                    <div class="activity-text"><strong>Sunita Patel</strong> added as new subject teacher</div>
                                    <div class="activity-time">Yesterday</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-avatar" style="background:linear-gradient(135deg,#ec4899,#f472b6)">AD</div>
                                <div>
                                    <div class="activity-text"><strong>Admin</strong> updated school timetable for March</div>
                                    <div class="activity-time">2 days ago</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /dashboard view -->

            <!-- ===================== STUDENTS VIEW ===================== -->
            <div class="view" id="view-students">
                <div class="page-header">
                    <div>
                        <div class="page-title">Student Management</div>
                        <div class="page-subtitle">Manage all enrolled students</div>
                    </div>
                    <div class="page-actions">
                        <button class="btn-outline-custom" onclick="showToast('info','Export','Exporting student data…')"><i class="fas fa-download"></i> Export</button>
                        <button class="btn-primary-custom" onclick="showToast('success','Student','New student form opened')"><i class="fas fa-plus"></i> Add Student</button>
                    </div>
                </div>
                <div class="stats-grid" style="margin-bottom:20px">
                    <div class="stat-card blue">
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">1,248</div>
                            <div class="stat-label">Total Students</div>
                        </div>
                    </div>
                    <div class="stat-card green">
                        <div class="stat-icon"><i class="fas fa-user-check"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">1,190</div>
                            <div class="stat-label">Active</div>
                        </div>
                    </div>
                    <div class="stat-card orange">
                        <div class="stat-icon"><i class="fas fa-user-clock"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">58</div>
                            <div class="stat-label">On Leave</div>
                        </div>
                    </div>
                    <div class="stat-card purple">
                        <div class="stat-icon"><i class="fas fa-user-plus"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">42</div>
                            <div class="stat-label">New This Month</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">All Students</div>
                        </div>
                        <div style="display:flex;gap:8px">
                            <select class="form-control-custom" style="width:auto;padding:7px 12px;font-size:.82rem">
                                <option>All Classes</option>
                                <option>Class 10</option>
                                <option>Class 11</option>
                                <option>Class 12</option>
                            </select>
                            <div style="position:relative"><i class="fas fa-search" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:var(--text-secondary);font-size:.8rem"></i><input type="text" placeholder="Search…" class="form-control-custom" style="padding-left:30px;width:180px"></div>
                        </div>
                    </div>
                    <div class="card-body-full scroll-area" style="max-height:440px">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Student</th>
                                    <th>Class</th>
                                    <th>Guardian</th>
                                    <th>Phone</th>
                                    <th>Fee Status</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="students-table-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===================== TEACHERS VIEW ===================== -->
            <div class="view" id="view-teachers">
                <div class="page-header">
                    <div>
                        <div class="page-title">Teacher Management</div>
                        <div class="page-subtitle">All teaching & non-teaching staff</div>
                    </div>
                    <div class="page-actions">
                        <button class="btn-outline-custom"><i class="fas fa-download"></i> Export</button>
                        <button class="btn-primary-custom" onclick="showToast('success','Teacher','New teacher form opened')"><i class="fas fa-plus"></i> Add Teacher</button>
                    </div>
                </div>
                <div class="stats-grid" style="grid-template-columns:repeat(4,1fr);margin-bottom:20px">
                    <div class="stat-card green">
                        <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">86</div>
                            <div class="stat-label">Total Staff</div>
                        </div>
                    </div>
                    <div class="stat-card blue">
                        <div class="stat-icon"><i class="fas fa-book"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">62</div>
                            <div class="stat-label">Teaching Staff</div>
                        </div>
                    </div>
                    <div class="stat-card orange">
                        <div class="stat-icon"><i class="fas fa-cogs"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">24</div>
                            <div class="stat-label">Non-Teaching</div>
                        </div>
                    </div>
                    <div class="stat-card purple">
                        <div class="stat-icon"><i class="fas fa-star"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">8</div>
                            <div class="stat-label">Department Heads</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Staff Directory</div>
                    </div>
                    <div class="card-body-full scroll-area" style="max-height:440px">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Teacher</th>
                                    <th>Subject</th>
                                    <th>Class Assigned</th>
                                    <th>Experience</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="teachers-table-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===================== CLASSES VIEW ===================== -->
            <div class="view" id="view-classes">
                <div class="page-header">
                    <div>
                        <div class="page-title">Class Management</div>
                        <div class="page-subtitle">Sections, rooms & class teachers</div>
                    </div>
                    <div class="page-actions">
                        <button class="btn-primary-custom" onclick="showToast('success','Class','New class form opened')"><i class="fas fa-plus"></i> Create Class</button>
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px">
                    <!-- Class Cards -->
                    <script>
                        const classData = [{
                            grade: 'Class 10',
                            sections: ['A', 'B', 'C', 'D'],
                            students: 124,
                            teacher: 'Mr. R. Sharma',
                            color: 'blue'
                        }, {
                            grade: 'Class 11',
                            sections: ['A', 'B', 'C'],
                            students: 96,
                            teacher: 'Mrs. S. Verma',
                            color: 'green'
                        }, {
                            grade: 'Class 12',
                            sections: ['A', 'B'],
                            students: 72,
                            teacher: 'Mr. P. Singh',
                            color: 'purple'
                        }, {
                            grade: 'Class 9',
                            sections: ['A', 'B', 'C', 'D'],
                            students: 132,
                            teacher: 'Mrs. K. Gupta',
                            color: 'orange'
                        }, {
                            grade: 'Class 8',
                            sections: ['A', 'B', 'C'],
                            students: 108,
                            teacher: 'Mr. A. Mishra',
                            color: 'teal'
                        }, {
                            grade: 'Class 7',
                            sections: ['A', 'B'],
                            students: 88,
                            teacher: 'Mrs. D. Nair',
                            color: 'pink'
                        }, {
                            grade: 'Class 6',
                            sections: ['A', 'B', 'C'],
                            students: 104,
                            teacher: 'Mr. N. Das',
                            color: 'indigo'
                        }, {
                            grade: 'Class 5',
                            sections: ['A', 'B'],
                            students: 76,
                            teacher: 'Mrs. R. Pillai',
                            color: 'red'
                        }];
                        document.addEventListener('DOMContentLoaded', () => {
                            const el = document.querySelector('#view-classes > div:last-child');
                            classData.forEach(c => {
                                el.innerHTML += `<div class="stat-card ${c.color}" style="flex-direction:column;gap:12px" onclick="showToast('info','${c.grade}','Viewing class details')"><div style="display:flex;align-items:center;justify-content:space-between"><div class="stat-icon"><i class="fas fa-school"></i></div><span class="badge-custom badge-active">Active</span></div><div><div style="font-family:var(--font-display);font-size:1.1rem;font-weight:800">${c.grade}</div><div style="font-size:.78rem;color:var(--text-secondary);margin-top:2px">Sections: ${c.sections.join(', ')}</div></div><div style="border-top:1px solid var(--border);padding-top:10px;display:flex;justify-content:space-between;align-items:center"><div><div style="font-size:.72rem;color:var(--text-secondary)">Students</div><div style="font-weight:700">${c.students}</div></div><div><div style="font-size:.72rem;color:var(--text-secondary)">Sections</div><div style="font-weight:700">${c.sections.length}</div></div></div><div style="font-size:.78rem;color:var(--text-secondary)"><i class="fas fa-user-tie me-1"></i>${c.teacher}</div></div>`;
                            });
                        });
                    </script>
                </div>
            </div>

            <!-- ===================== SUBJECTS VIEW ===================== -->
            <div class="view" id="view-subjects">
                <div class="page-header">
                    <div>
                        <div class="page-title">Subject Management</div>
                        <div class="page-subtitle">All subjects & syllabus overview</div>
                    </div>
                    <div class="page-actions">
                        <button class="btn-primary-custom" onclick="showToast('success','Subject','New subject added')"><i class="fas fa-plus"></i> Add Subject</button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Subject Directory</div>
                    </div>
                    <div class="card-body-full">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Code</th>
                                    <th>Department</th>
                                    <th>Classes</th>
                                    <th>Teachers</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:8px">
                                            <div style="width:32px;height:32px;border-radius:8px;background:var(--primary-light);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:.8rem"><i class="fas fa-calculator"></i></div><strong>Mathematics</strong>
                                        </div>
                                    </td>
                                    <td><span class="badge-custom badge-primary">MATH-101</span></td>
                                    <td>Science</td>
                                    <td>8–12</td>
                                    <td>6</td>
                                    <td><span class="badge-custom badge-active">Active</span></td>
                                    <td><button class="btn-outline-custom" style="padding:4px 10px;font-size:.75rem" onclick="showToast('info','Math','Editing subject')">Edit</button></td>
                                </tr>
                                <tr>
                                    <td>02</td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:8px">
                                            <div style="width:32px;height:32px;border-radius:8px;background:var(--success-light);display:flex;align-items:center;justify-content:center;color:var(--success);font-size:.8rem"><i class="fas fa-flask"></i></div><strong>Science</strong>
                                        </div>
                                    </td>
                                    <td><span class="badge-custom badge-primary">SCI-201</span></td>
                                    <td>Science</td>
                                    <td>6–12</td>
                                    <td>8</td>
                                    <td><span class="badge-custom badge-active">Active</span></td>
                                    <td><button class="btn-outline-custom" style="padding:4px 10px;font-size:.75rem">Edit</button></td>
                                </tr>
                                <tr>
                                    <td>03</td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:8px">
                                            <div style="width:32px;height:32px;border-radius:8px;background:var(--accent-light);display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:.8rem"><i class="fas fa-globe"></i></div><strong>Social Studies</strong>
                                        </div>
                                    </td>
                                    <td><span class="badge-custom badge-primary">SOC-301</span></td>
                                    <td>Humanities</td>
                                    <td>6–10</td>
                                    <td>5</td>
                                    <td><span class="badge-custom badge-active">Active</span></td>
                                    <td><button class="btn-outline-custom" style="padding:4px 10px;font-size:.75rem">Edit</button></td>
                                </tr>
                                <tr>
                                    <td>04</td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:8px">
                                            <div style="width:32px;height:32px;border-radius:8px;background:var(--purple-light);display:flex;align-items:center;justify-content:center;color:var(--purple);font-size:.8rem"><i class="fas fa-language"></i></div><strong>English</strong>
                                        </div>
                                    </td>
                                    <td><span class="badge-custom badge-primary">ENG-401</span></td>
                                    <td>Languages</td>
                                    <td>1–12</td>
                                    <td>10</td>
                                    <td><span class="badge-custom badge-active">Active</span></td>
                                    <td><button class="btn-outline-custom" style="padding:4px 10px;font-size:.75rem">Edit</button></td>
                                </tr>
                                <tr>
                                    <td>05</td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:8px">
                                            <div style="width:32px;height:32px;border-radius:8px;background:var(--teal-light);display:flex;align-items:center;justify-content:center;color:var(--teal);font-size:.8rem"><i class="fas fa-laptop-code"></i></div><strong>Computer Science</strong>
                                        </div>
                                    </td>
                                    <td><span class="badge-custom badge-primary">CS-501</span></td>
                                    <td>Technology</td>
                                    <td>9–12</td>
                                    <td>4</td>
                                    <td><span class="badge-custom badge-active">Active</span></td>
                                    <td><button class="btn-outline-custom" style="padding:4px 10px;font-size:.75rem">Edit</button></td>
                                </tr>
                                <tr>
                                    <td>06</td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:8px">
                                            <div style="width:32px;height:32px;border-radius:8px;background:#fce7f3;display:flex;align-items:center;justify-content:center;color:#ec4899;font-size:.8rem"><i class="fas fa-paint-brush"></i></div><strong>Fine Arts</strong>
                                        </div>
                                    </td>
                                    <td><span class="badge-custom badge-primary">ART-601</span></td>
                                    <td>Arts</td>
                                    <td>6–10</td>
                                    <td>3</td>
                                    <td><span class="badge-custom badge-active">Active</span></td>
                                    <td><button class="btn-outline-custom" style="padding:4px 10px;font-size:.75rem">Edit</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===================== MARKSHEET VIEW ===================== -->
            <div class="view" id="view-marksheet">
                <div class="page-header">
                    <div>
                        <div class="page-title">Marksheet Management</div>
                        <div class="page-subtitle">Exam results & grade reports</div>
                    </div>
                    <div class="page-actions">
                        <button class="btn-outline-custom" onclick="showToast('info','Print','Printing marksheets…')"><i class="fas fa-print"></i> Print</button>
                        <button class="btn-primary-custom" onclick="showToast('success','Result','Result entry form opened')"><i class="fas fa-plus"></i> Enter Result</button>
                    </div>
                </div>
                <div class="stats-grid" style="grid-template-columns:repeat(4,1fr);margin-bottom:20px">
                    <div class="stat-card green">
                        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">98.2%</div>
                            <div class="stat-label">Pass Rate</div>
                        </div>
                    </div>
                    <div class="stat-card blue">
                        <div class="stat-icon"><i class="fas fa-star"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">76.4</div>
                            <div class="stat-label">Average Score</div>
                        </div>
                    </div>
                    <div class="stat-card orange">
                        <div class="stat-icon"><i class="fas fa-trophy"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">142</div>
                            <div class="stat-label">Distinction</div>
                        </div>
                    </div>
                    <div class="stat-card red">
                        <div class="stat-icon"><i class="fas fa-exclamation-circle"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">22</div>
                            <div class="stat-label">Failed</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Result Entries</div>
                        <div style="display:flex;gap:8px">
                            <select class="form-control-custom" style="width:auto;padding:7px 12px;font-size:.82rem">
                                <option>Term 1 — 2024-25</option>
                                <option>Term 2 — 2024-25</option>
                            </select>
                            <select class="form-control-custom" style="width:auto;padding:7px 12px;font-size:.82rem">
                                <option>Class 10-A</option>
                                <option>Class 10-B</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body-full">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Math</th>
                                    <th>Science</th>
                                    <th>English</th>
                                    <th>Social</th>
                                    <th>CS</th>
                                    <th>Total</th>
                                    <th>%</th>
                                    <th>Grade</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Arjun Sharma</strong></td>
                                    <td>92</td>
                                    <td>88</td>
                                    <td>85</td>
                                    <td>79</td>
                                    <td>95</td>
                                    <td>439</td>
                                    <td>87.8%</td>
                                    <td style="font-weight:700;color:var(--success)">A+</td>
                                    <td><span class="badge-custom badge-active">Pass</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Priya Gupta</strong></td>
                                    <td>78</td>
                                    <td>82</td>
                                    <td>91</td>
                                    <td>88</td>
                                    <td>74</td>
                                    <td>413</td>
                                    <td>82.6%</td>
                                    <td style="font-weight:700;color:var(--success)">A</td>
                                    <td><span class="badge-custom badge-active">Pass</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Rahul Kumar</strong></td>
                                    <td>65</td>
                                    <td>70</td>
                                    <td>68</td>
                                    <td>72</td>
                                    <td>60</td>
                                    <td>335</td>
                                    <td>67.0%</td>
                                    <td style="font-weight:700;color:var(--primary)">B</td>
                                    <td><span class="badge-custom badge-active">Pass</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Sneha Das</strong></td>
                                    <td>88</td>
                                    <td>90</td>
                                    <td>87</td>
                                    <td>84</td>
                                    <td>92</td>
                                    <td>441</td>
                                    <td>88.2%</td>
                                    <td style="font-weight:700;color:var(--success)">A+</td>
                                    <td><span class="badge-custom badge-active">Pass</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Vikram Singh</strong></td>
                                    <td>45</td>
                                    <td>52</td>
                                    <td>48</td>
                                    <td>55</td>
                                    <td>40</td>
                                    <td>240</td>
                                    <td>48.0%</td>
                                    <td style="font-weight:700;color:var(--danger)">D</td>
                                    <td><span class="badge-custom badge-inactive">Fail</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===================== FEES VIEW ===================== -->
            <div class="view" id="view-fees">
                <div class="page-header">
                    <div>
                        <div class="page-title">Fee Management</div>
                        <div class="page-subtitle">Track, collect & manage school fees</div>
                    </div>
                    <div class="page-actions">
                        <button class="btn-outline-custom" onclick="showToast('info','Reminder','Fee reminders sent!')"><i class="fas fa-bell"></i> Send Reminder</button>
                        <button class="btn-primary-custom" onclick="showToast('success','Fee','Fee collection form opened')"><i class="fas fa-plus"></i> Collect Fee</button>
                    </div>
                </div>
                <div class="stats-grid" style="grid-template-columns:repeat(4,1fr);margin-bottom:20px">
                    <div class="stat-card green">
                        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">₹8.42L</div>
                            <div class="stat-label">Collected</div>
                        </div>
                    </div>
                    <div class="stat-card red">
                        <div class="stat-icon"><i class="fas fa-clock"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">₹1.88L</div>
                            <div class="stat-label">Pending</div>
                        </div>
                    </div>
                    <div class="stat-card orange">
                        <div class="stat-icon"><i class="fas fa-exclamation"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">58</div>
                            <div class="stat-label">Overdue</div>
                        </div>
                    </div>
                    <div class="stat-card blue">
                        <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">81.7%</div>
                            <div class="stat-label">Collection Rate</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Fee Records</div>
                    </div>
                    <div class="card-body-full scroll-area" style="max-height:420px">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th>Receipt #</th>
                                    <th>Student</th>
                                    <th>Class</th>
                                    <th>Fee Type</th>
                                    <th>Amount</th>
                                    <th>Due Date</th>
                                    <th>Paid On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="fees-table-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===================== INVOICES VIEW ===================== -->
            <div class="view" id="view-invoices">
                <div class="page-header">
                    <div>
                        <div class="page-title">Invoice Management</div>
                        <div class="page-subtitle">Generate & track all invoices</div>
                    </div>
                    <div class="page-actions">
                        <button class="btn-outline-custom" onclick="showToast('info','Export','Exporting invoice list…')"><i class="fas fa-download"></i> Export</button>
                        <button class="btn-primary-custom" onclick="showToast('success','Invoice','New invoice created')"><i class="fas fa-plus"></i> New Invoice</button>
                    </div>
                </div>
                <div class="stats-grid" style="grid-template-columns:repeat(4,1fr);margin-bottom:20px">
                    <div class="stat-card blue">
                        <div class="stat-icon"><i class="fas fa-file-invoice"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">312</div>
                            <div class="stat-label">Total Invoices</div>
                        </div>
                    </div>
                    <div class="stat-card green">
                        <div class="stat-icon"><i class="fas fa-check"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">268</div>
                            <div class="stat-label">Paid</div>
                        </div>
                    </div>
                    <div class="stat-card orange">
                        <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">32</div>
                            <div class="stat-label">Pending</div>
                        </div>
                    </div>
                    <div class="stat-card red">
                        <div class="stat-icon"><i class="fas fa-times-circle"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">12</div>
                            <div class="stat-label">Overdue</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Invoice List</div>
                    </div>
                    <div class="card-body-full scroll-area" style="max-height:420px">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th>Invoice #</th>
                                    <th>Student</th>
                                    <th>Class</th>
                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="invoices-table-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===================== PROFILE VIEW ===================== -->
            <div class="view" id="view-profile">
                <div class="page-header">
                    <div>
                        <div class="page-title">Profile Management</div>
                        <div class="page-subtitle">Manage your account & preferences</div>
                    </div>
                </div>
                <div class="card" style="margin-bottom:20px">
                    <div class="profile-banner">
                        <div class="profile-avatar-wrap">AD</div>
                        <div class="profile-actions">
                            <button class="btn-outline-custom" style="background:rgba(255,255,255,.15);border-color:rgba(255,255,255,.3);color:#fff" onclick="showToast('info','Photo','Photo upload opened')"><i class="fas fa-camera"></i> Change Photo</button>
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-name">Admin User</div>
                        <div class="profile-meta"><i class="fas fa-shield-alt me-2" style="color:var(--primary)"></i>Super Administrator · EduCore ERP v3.2</div>
                        <div class="profile-stats-row">
                            <div class="profile-stat">
                                <div class="profile-stat-val">1,248</div>
                                <div class="profile-stat-label">Students</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-val">86</div>
                                <div class="profile-stat-label">Teachers</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-val">42</div>
                                <div class="profile-stat-label">Classes</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-val">312</div>
                                <div class="profile-stat-label">Invoices</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-grid">
                    <!-- Personal Info -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Personal Information</div><button class="btn-outline-custom" style="padding:6px 12px;font-size:.78rem" onclick="showToast('success','Saved','Profile information updated')"><i class="fas fa-edit"></i> Edit</button>
                        </div>
                        <div class="card-body">
                            <div class="info-row"><span class="info-label">Full Name</span><span class="info-value">Admin User</span></div>
                            <div class="info-row"><span class="info-label">Email</span><span class="info-value"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="b1d0d5dcd8dff1d4d5c4d2dec3d49fd8df">[email&#160;protected]</a></span></div>
                            <div class="info-row"><span class="info-label">Phone</span><span class="info-value">+91 98765 43210</span></div>
                            <div class="info-row"><span class="info-label">Role</span><span class="info-value"><span class="badge-custom badge-primary">Super Admin</span></span></div>
                            <div class="info-row"><span class="info-label">Department</span><span class="info-value">Administration</span></div>
                            <div class="info-row"><span class="info-label">Joined</span><span class="info-value">April 1, 2020</span></div>
                            <div class="info-row"><span class="info-label">Employee ID</span><span class="info-value">#EMP-001</span></div>
                        </div>
                    </div>
                    <!-- Edit Form -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Update Profile</div>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group"><label class="form-label">First Name</label><input class="form-control-custom" value="Admin"></div>
                                <div class="form-group"><label class="form-label">Last Name</label><input class="form-control-custom" value="User"></div>
                            </div>
                            <div class="form-group"><label class="form-label">Email Address</label><input class="form-control-custom" value="admin@educore.in" type="email"></div>
                            <div class="form-group"><label class="form-label">Phone Number</label><input class="form-control-custom" value="+91 98765 43210"></div>
                            <div class="form-row">
                                <div class="form-group"><label class="form-label">Department</label><select class="form-control-custom">
                                        <option>Administration</option>
                                        <option>Academics</option>
                                        <option>Finance</option>
                                    </select></div>
                                <div class="form-group"><label class="form-label">Location</label><input class="form-control-custom" value="New Delhi, India"></div>
                            </div>
                            <button class="btn-primary-custom" style="width:100%;justify-content:center" onclick="showToast('success','Saved','Profile updated successfully!')"><i class="fas fa-save"></i> Save Changes</button>
                        </div>
                    </div>
                    <!-- Change Password -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Change Password</div>
                        </div>
                        <div class="card-body">
                            <div class="form-group"><label class="form-label">Current Password</label><input class="form-control-custom" type="password" placeholder="Enter current password"></div>
                            <div class="form-group"><label class="form-label">New Password</label><input class="form-control-custom" type="password" placeholder="Enter new password"></div>
                            <div class="form-group"><label class="form-label">Confirm New Password</label><input class="form-control-custom" type="password" placeholder="Confirm new password"></div>
                            <button class="btn-primary-custom" style="width:100%;justify-content:center" onclick="showToast('success','Password','Password changed successfully!')"><i class="fas fa-lock"></i> Update Password</button>
                        </div>
                    </div>
                    <!-- Preferences -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Preferences & Notifications</div>
                        </div>
                        <div class="card-body">
                            <div style="display:flex;flex-direction:column;gap:14px">
                                <div style="display:flex;align-items:center;justify-content:space-between">
                                    <div>
                                        <div style="font-weight:600;font-size:.875rem">Email Notifications</div>
                                        <div style="font-size:.78rem;color:var(--text-secondary)">Receive fee & admission alerts</div>
                                    </div>
                                    <div class="toggle-wrap"><input type="checkbox" id="t1" checked hidden><label for="t1" style="width:44px;height:24px;background:var(--primary);border-radius:99px;cursor:pointer;position:relative;display:block;transition:.3s"><span style="position:absolute;top:3px;left:3px;width:18px;height:18px;background:#fff;border-radius:50%;transition:.3s;left:23px"></span></label></div>
                                </div>
                                <div style="display:flex;align-items:center;justify-content:space-between">
                                    <div>
                                        <div style="font-weight:600;font-size:.875rem">SMS Alerts</div>
                                        <div style="font-size:.78rem;color:var(--text-secondary)">Get SMS for urgent notices</div>
                                    </div>
                                    <div><input type="checkbox" id="t2" hidden><label for="t2" style="width:44px;height:24px;background:var(--border);border-radius:99px;cursor:pointer;position:relative;display:block;transition:.3s"><span style="position:absolute;top:3px;left:3px;width:18px;height:18px;background:#fff;border-radius:50%;transition:.3s"></span></label></div>
                                </div>
                                <div style="display:flex;align-items:center;justify-content:space-between">
                                    <div>
                                        <div style="font-weight:600;font-size:.875rem">Dark Mode</div>
                                        <div style="font-size:.78rem;color:var(--text-secondary)">Switch to dark interface</div>
                                    </div>
                                    <div><input type="checkbox" id="t3" hidden><label for="t3" style="width:44px;height:24px;background:var(--border);border-radius:99px;cursor:pointer;position:relative;display:block;transition:.3s"><span style="position:absolute;top:3px;left:3px;width:18px;height:18px;background:#fff;border-radius:50%;transition:.3s"></span></label></div>
                                </div>
                                <div style="display:flex;align-items:center;justify-content:space-between">
                                    <div>
                                        <div style="font-weight:600;font-size:.875rem">Weekly Report</div>
                                        <div style="font-size:.78rem;color:var(--text-secondary)">Receive weekly summary</div>
                                    </div>
                                    <div><input type="checkbox" id="t4" checked hidden><label for="t4" style="width:44px;height:24px;background:var(--primary);border-radius:99px;cursor:pointer;position:relative;display:block;transition:.3s"><span style="position:absolute;top:3px;left:3px;width:18px;height:18px;background:#fff;border-radius:50%;transition:.3s;left:23px"></span></label></div>
                                </div>
                            </div>
                            <button class="btn-outline-custom" style="width:100%;justify-content:center;margin-top:16px" onclick="showToast('success','Preferences','Preferences saved!')"><i class="fas fa-save"></i> Save Preferences</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ===================== MARKSHEET TEMPLATE VIEW ===================== -->
            <div class="view" id="view-marksheet-template">
                <div class="page-header">
                    <div>
                        <div class="page-title">Marksheet Templates</div>
                        <div class="page-subtitle">Choose & customize report card formats</div>
                    </div>
                    <div class="page-actions">
                        <button class="btn-primary-custom" onclick="showToast('success','Template','Custom template builder opened')"><i class="fas fa-plus"></i> Create Template</button>
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;margin-bottom:24px">
                    <!-- Template Card 1 -->
                    <div class="card" style="cursor:pointer;transition:var(--transition)" onmouseenter="this.style.transform='translateY(-4px)'" onmouseleave="this.style.transform=''" onclick="showView('marksheet-demo');showToast('success','Template','Classic Blue template selected!')">
                        <div style="height:140px;background:linear-gradient(135deg,#1a56db,#4f46e5);border-radius:var(--radius) var(--radius) 0 0;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden">
                            <div style="position:absolute;inset:0;display:grid;grid-template-columns:repeat(3,1fr);grid-template-rows:repeat(2,1fr);gap:4px;padding:12px;opacity:.15">
                                <div style="background:#fff;border-radius:2px"></div>
                                <div style="background:#fff;border-radius:2px"></div>
                                <div style="background:#fff;border-radius:2px"></div>
                                <div style="background:#fff;border-radius:2px"></div>
                                <div style="background:#fff;border-radius:2px"></div>
                                <div style="background:#fff;border-radius:2px"></div>
                            </div>
                            <div style="text-align:center;color:#fff;z-index:1"><i class="fas fa-file-alt" style="font-size:2rem;margin-bottom:6px;display:block"></i>
                                <div style="font-family:var(--font-display);font-weight:800;font-size:.95rem">Classic Blue</div>
                            </div>
                            <div style="position:absolute;top:10px;right:10px;background:#10b981;color:#fff;font-size:.65rem;font-weight:700;padding:3px 8px;border-radius:99px">DEFAULT</div>
                        </div>
                        <div class="card-body" style="padding:14px 16px">
                            <div style="font-weight:700;margin-bottom:4px">Classic Blue Template</div>
                            <div style="font-size:.78rem;color:var(--text-secondary);margin-bottom:12px">Professional blue theme with full subject breakdown, grades & signatures</div>
                            <div style="display:flex;gap:8px"><button class="btn-primary-custom" style="padding:6px 12px;font-size:.78rem;flex:1;justify-content:center" onclick="event.stopPropagation();showView('marksheet-demo')"><i class="fas fa-eye"></i> Preview</button><button class="btn-outline-custom" style="padding:6px 12px;font-size:.78rem" onclick="event.stopPropagation();showToast('info','Edit','Template editor opening…')"><i class="fas fa-edit"></i></button></div>
                        </div>
                    </div>
                    <!-- Template Card 2 -->
                    <div class="card" style="cursor:pointer;transition:var(--transition)" onmouseenter="this.style.transform='translateY(-4px)'" onmouseleave="this.style.transform=''" onclick="showToast('info','Template','Green Minimal template preview')">
                        <div style="height:140px;background:linear-gradient(135deg,#10b981,#06b6d4);border-radius:var(--radius) var(--radius) 0 0;display:flex;align-items:center;justify-content:center">
                            <div style="text-align:center;color:#fff"><i class="fas fa-leaf" style="font-size:2rem;margin-bottom:6px;display:block"></i>
                                <div style="font-family:var(--font-display);font-weight:800;font-size:.95rem">Green Minimal</div>
                            </div>
                        </div>
                        <div class="card-body" style="padding:14px 16px">
                            <div style="font-weight:700;margin-bottom:4px">Green Minimal Template</div>
                            <div style="font-size:.78rem;color:var(--text-secondary);margin-bottom:12px">Clean minimal design with green accents, ideal for primary classes</div>
                            <div style="display:flex;gap:8px"><button class="btn-outline-custom" style="padding:6px 12px;font-size:.78rem;flex:1;justify-content:center"><i class="fas fa-eye"></i> Preview</button><button class="btn-outline-custom" style="padding:6px 12px;font-size:.78rem"><i class="fas fa-edit"></i></button></div>
                        </div>
                    </div>
                    <!-- Template Card 3 -->
                    <div class="card" style="cursor:pointer;transition:var(--transition)" onmouseenter="this.style.transform='translateY(-4px)'" onmouseleave="this.style.transform=''">
                        <div style="height:140px;background:linear-gradient(135deg,#7c3aed,#ec4899);border-radius:var(--radius) var(--radius) 0 0;display:flex;align-items:center;justify-content:center">
                            <div style="text-align:center;color:#fff"><i class="fas fa-star" style="font-size:2rem;margin-bottom:6px;display:block"></i>
                                <div style="font-family:var(--font-display);font-weight:800;font-size:.95rem">Royal Premium</div>
                            </div>
                        </div>
                        <div class="card-body" style="padding:14px 16px">
                            <div style="font-weight:700;margin-bottom:4px">Royal Premium Template</div>
                            <div style="font-size:.78rem;color:var(--text-secondary);margin-bottom:12px">Luxurious purple-gold design for annual result ceremonies</div>
                            <div style="display:flex;gap:8px"><button class="btn-outline-custom" style="padding:6px 12px;font-size:.78rem;flex:1;justify-content:center"><i class="fas fa-eye"></i> Preview</button><button class="btn-outline-custom" style="padding:6px 12px;font-size:.78rem"><i class="fas fa-edit"></i></button></div>
                        </div>
                    </div>
                    <!-- Template Card 4 - Add New -->
                    <div class="card" style="cursor:pointer;border:2px dashed var(--border);box-shadow:none;display:flex;align-items:center;justify-content:center;min-height:220px;transition:var(--transition)" onmouseenter="this.style.borderColor='var(--primary)';this.style.background='var(--primary-light)'" onmouseleave="this.style.borderColor='var(--border)';this.style.background=''" onclick="showToast('info','Builder','Template builder opening…')">
                        <div style="text-align:center;color:var(--text-secondary)">
                            <i class="fas fa-plus-circle" style="font-size:2rem;margin-bottom:10px;display:block;color:var(--primary)"></i>
                            <div style="font-weight:700;color:var(--text-primary)">Create Custom Template</div>
                            <div style="font-size:.78rem;margin-top:4px">Design your own marksheet layout</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===================== MARKSHEET DEMO VIEW ===================== -->
            <div class="view" id="view-marksheet-demo">
                <div class="page-header">
                    <div>
                        <div class="page-title">Marksheet Preview</div>
                        <div class="page-subtitle">Classic Blue — Demo Report Card</div>
                    </div>
                    <div class="page-actions">
                        <button class="btn-outline-custom" onclick="showView('marksheet-template')"><i class="fas fa-arrow-left"></i> Back</button>
                        <button class="btn-outline-custom" onclick="showToast('info','Print','Opening print dialog…')"><i class="fas fa-print"></i> Print</button>
                        <button class="btn-primary-custom" onclick="showToast('success','PDF','Marksheet PDF downloaded!')"><i class="fas fa-download"></i> Download PDF</button>
                    </div>
                </div>
                <div class="marksheet-template" style="max-width:860px;margin:0 auto">
                    <!-- Header -->
                    <div class="ms-header">
                        <div class="ms-school-logo">EC</div>
                        <div style="flex:1">
                            <div class="ms-school-name">EduCore Model School</div>
                            <div class="ms-school-sub">Affiliated to CBSE · Estd. 2005 · Reg. No. CBSE/2005/DEL/0042</div>
                            <div class="ms-school-sub" style="margin-top:2px"><i class="fas fa-map-marker-alt me-1"></i>15 Education Lane, New Delhi – 110001 &nbsp;|&nbsp; <i class="fas fa-phone me-1"></i>+91-11-2345-6789</div>
                        </div>
                        <div style="text-align:right">
                            <div style="font-size:.7rem;opacity:.7">Academic Year</div>
                            <div style="font-family:var(--font-display);font-size:1.1rem;font-weight:800">2024–25</div>
                            <div style="font-size:.7rem;opacity:.7;margin-top:4px">Term II Examination</div>
                        </div>
                    </div>
                    <!-- Title Bar -->
                    <div class="ms-title-bar">
                        <span class="ms-title"><i class="fas fa-scroll me-2"></i>PROGRESS REPORT CARD</span>
                        <span style="font-size:.78rem;color:var(--text-secondary)">Issued: March 4, 2025</span>
                    </div>
                    <!-- Student Info -->
                    <div class="ms-info-row">
                        <div class="ms-info-box">
                            <div class="ms-info-label">Student Name</div>
                            <div class="ms-info-value">Arjun Sharma</div>
                        </div>
                        <div class="ms-info-box">
                            <div class="ms-info-label">Admission No.</div>
                            <div class="ms-info-value">#STU-1248</div>
                        </div>
                        <div class="ms-info-box">
                            <div class="ms-info-label">Class & Section</div>
                            <div class="ms-info-value">Class 10 — A</div>
                        </div>
                        <div class="ms-info-box">
                            <div class="ms-info-label">Roll No.</div>
                            <div class="ms-info-value">12</div>
                        </div>
                        <div class="ms-info-box">
                            <div class="ms-info-label">Father's Name</div>
                            <div class="ms-info-value">Raj Sharma</div>
                        </div>
                        <div class="ms-info-box">
                            <div class="ms-info-label">Date of Birth</div>
                            <div class="ms-info-value">14 Aug 2009</div>
                        </div>
                    </div>
                    <!-- Marks Table -->
                    <div style="padding:0 0 0 0">
                        <table class="ms-table">
                            <thead>
                                <tr>
                                    <th style="width:40px">S.No</th>
                                    <th style="text-align:left">Subject</th>
                                    <th>Max<br>Marks</th>
                                    <th>Theory<br>(80)</th>
                                    <th>Practical<br>(20)</th>
                                    <th>Total<br>(100)</th>
                                    <th>%</th>
                                    <th>Grade</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td style="text-align:left;font-weight:600">Mathematics</td>
                                    <td>100</td>
                                    <td>74</td>
                                    <td>18</td>
                                    <td><strong>92</strong></td>
                                    <td>92%</td>
                                    <td class="ms-grade-a">A1</td>
                                    <td style="font-size:.78rem;color:var(--success)">Excellent</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td style="text-align:left;font-weight:600">Science</td>
                                    <td>100</td>
                                    <td>70</td>
                                    <td>18</td>
                                    <td><strong>88</strong></td>
                                    <td>88%</td>
                                    <td class="ms-grade-a">A1</td>
                                    <td style="font-size:.78rem;color:var(--success)">Excellent</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td style="text-align:left;font-weight:600">English</td>
                                    <td>100</td>
                                    <td>72</td>
                                    <td>13</td>
                                    <td><strong>85</strong></td>
                                    <td>85%</td>
                                    <td class="ms-grade-a">A2</td>
                                    <td style="font-size:.78rem;color:#3b82f6">Very Good</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td style="text-align:left;font-weight:600">Social Studies</td>
                                    <td>100</td>
                                    <td>66</td>
                                    <td>13</td>
                                    <td><strong>79</strong></td>
                                    <td>79%</td>
                                    <td class="ms-grade-b">B1</td>
                                    <td style="font-size:.78rem;color:#3b82f6">Good</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td style="text-align:left;font-weight:600">Computer Science</td>
                                    <td>100</td>
                                    <td>78</td>
                                    <td>17</td>
                                    <td><strong>95</strong></td>
                                    <td>95%</td>
                                    <td class="ms-grade-a">A1</td>
                                    <td style="font-size:.78rem;color:var(--success)">Outstanding</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td style="text-align:left;font-weight:600">Hindi</td>
                                    <td>100</td>
                                    <td>70</td>
                                    <td>10</td>
                                    <td><strong>80</strong></td>
                                    <td>80%</td>
                                    <td class="ms-grade-b">B1</td>
                                    <td style="font-size:.78rem;color:#3b82f6">Good</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr style="background:#eff6ff">
                                    <td colspan="2" style="text-align:left;font-weight:800;padding:12px 16px">TOTAL / AGGREGATE</td>
                                    <td><strong>600</strong></td>
                                    <td><strong>430</strong></td>
                                    <td><strong>89</strong></td>
                                    <td style="font-size:1rem"><strong>519</strong></td>
                                    <td style="color:var(--primary);font-weight:800">86.5%</td>
                                    <td class="ms-grade-a" style="font-size:1rem">A1</td>
                                    <td><span style="background:var(--success-light);color:var(--success);font-size:.75rem;font-weight:700;padding:3px 8px;border-radius:99px">PASS</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- Attendance & Co-Curricular -->
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:0;border-top:1px solid var(--border)">
                        <div style="padding:16px 20px;border-right:1px solid var(--border)">
                            <div style="font-weight:800;font-size:.85rem;margin-bottom:12px;color:var(--primary)"><i class="fas fa-calendar-check me-2"></i>ATTENDANCE</div>
                            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px">
                                <div style="text-align:center;background:var(--body-bg);padding:10px;border-radius:var(--radius-sm)">
                                    <div style="font-family:var(--font-display);font-size:1.2rem;font-weight:800;color:var(--primary)">220</div>
                                    <div style="font-size:.7rem;color:var(--text-secondary)">Working Days</div>
                                </div>
                                <div style="text-align:center;background:var(--success-light);padding:10px;border-radius:var(--radius-sm)">
                                    <div style="font-family:var(--font-display);font-size:1.2rem;font-weight:800;color:var(--success)">207</div>
                                    <div style="font-size:.7rem;color:var(--success)">Present</div>
                                </div>
                                <div style="text-align:center;background:var(--danger-light);padding:10px;border-radius:var(--radius-sm)">
                                    <div style="font-family:var(--font-display);font-size:1.2rem;font-weight:800;color:var(--danger)">13</div>
                                    <div style="font-size:.7rem;color:var(--danger)">Absent</div>
                                </div>
                            </div>
                            <div style="margin-top:10px;background:var(--body-bg);padding:8px 12px;border-radius:var(--radius-sm);font-size:.82rem"><span style="font-weight:600">Attendance %: </span><span style="color:var(--success);font-weight:800">94.1%</span></div>
                        </div>
                        <div style="padding:16px 20px">
                            <div style="font-weight:800;font-size:.85rem;margin-bottom:12px;color:var(--primary)"><i class="fas fa-star me-2"></i>CO-CURRICULAR ACTIVITIES</div>
                            <table style="width:100%;font-size:.82rem">
                                <tr style="border-bottom:1px solid var(--border)">
                                    <td style="padding:5px 0;color:var(--text-secondary)">Sports & Games</td>
                                    <td style="font-weight:700;color:var(--success);text-align:right">A (Excellent)</td>
                                </tr>
                                <tr style="border-bottom:1px solid var(--border)">
                                    <td style="padding:5px 0;color:var(--text-secondary)">Drawing & Arts</td>
                                    <td style="font-weight:700;color:#3b82f6;text-align:right">B (Good)</td>
                                </tr>
                                <tr style="border-bottom:1px solid var(--border)">
                                    <td style="padding:5px 0;color:var(--text-secondary)">Discipline & Conduct</td>
                                    <td style="font-weight:700;color:var(--success);text-align:right">A (Outstanding)</td>
                                </tr>
                                <tr>
                                    <td style="padding:5px 0;color:var(--text-secondary)">Overall Behaviour</td>
                                    <td style="font-weight:700;color:var(--success);text-align:right">A (Excellent)</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- Teacher Remarks -->
                    <div style="padding:14px 20px;background:var(--body-bg);border-top:1px solid var(--border)">
                        <div style="font-weight:800;font-size:.82rem;color:var(--primary);margin-bottom:6px"><i class="fas fa-comment-alt me-2"></i>CLASS TEACHER'S REMARKS</div>
                        <div style="font-size:.85rem;color:var(--text-primary);font-style:italic">"Arjun is a brilliant and hardworking student. He consistently performs well in all subjects, especially in Computer Science and Mathematics. He is encouraged to focus on Social Studies and English to achieve even higher scores."</div>
                        <div style="font-size:.78rem;color:var(--text-secondary);margin-top:6px">— Mr. Rajesh Sharma, Class Teacher</div>
                    </div>
                    <!-- Result Banner -->
                    <div class="ms-result-banner pass">🎉 RESULT: PASS — DISTINCTION &nbsp;|&nbsp; Overall Grade: A1 &nbsp;|&nbsp; Percentage: 86.5%</div>
                    <!-- Signatures -->
                    <div class="ms-footer-row">
                        <div class="ms-sign-box">Class Teacher's Signature</div>
                        <div class="ms-sign-box">Principal's Signature</div>
                        <div class="ms-sign-box">Parent / Guardian's Signature</div>
                    </div>
                    <div style="padding:10px 20px;text-align:center;font-size:.72rem;color:var(--text-secondary);background:var(--body-bg)">This is a computer-generated report card. No signature required for digital copies. · EduCore ERP v3.2 · Generated: March 4, 2025</div>
                </div>
            </div>

            <!-- ===================== ATTENDANCE VIEW ===================== -->
            <div class="view" id="view-attendance">
                <div class="page-header">
                    <div>
                        <div class="page-title">Take Attendance</div>
                        <div class="page-subtitle">Mark daily attendance class-wise</div>
                    </div>
                    <div class="page-actions">
                        <div style="display:flex;gap:8px;align-items:center">
                            <select class="form-control-custom" id="att-class-sel" style="width:auto;padding:8px 14px" onchange="renderAttendanceTable()">
                                <option value="10-A">Class 10 — A (38 Students)</option>
                                <option value="9-B">Class 9 — B (36 Students)</option>
                                <option value="11-C">Class 11 — C (34 Students)</option>
                                <option value="8-A">Class 8 — A (40 Students)</option>
                            </select>
                            <input type="date" class="form-control-custom" id="att-date" style="width:auto;padding:8px 14px">
                            <button class="btn-primary-custom" onclick="saveAttendance()"><i class="fas fa-save"></i> Save Attendance</button>
                        </div>
                    </div>
                </div>
                <!-- Summary Bar -->
                <div class="att-summary-bar">
                    <div class="att-sum-item">
                        <div class="att-dot" style="background:var(--success)"></div><span id="att-present-count">0</span> Present
                    </div>
                    <div class="att-sum-item">
                        <div class="att-dot" style="background:var(--danger)"></div><span id="att-absent-count">0</span> Absent
                    </div>
                    <div class="att-sum-item">
                        <div class="att-dot" style="background:var(--accent)"></div><span id="att-late-count">0</span> Late
                    </div>
                    <div class="att-sum-item" style="margin-left:auto">
                        <div class="att-dot" style="background:var(--border)"></div><span id="att-total-count">0</span> Total
                    </div>
                    <div style="display:flex;gap:6px">
                        <button class="btn-outline-custom" style="padding:5px 12px;font-size:.78rem" onclick="markAll('present')"><i class="fas fa-check-circle" style="color:var(--success)"></i> All Present</button>
                        <button class="btn-outline-custom" style="padding:5px 12px;font-size:.78rem" onclick="markAll('absent')"><i class="fas fa-times-circle" style="color:var(--danger)"></i> All Absent</button>
                        <button class="btn-outline-custom" style="padding:5px 12px;font-size:.78rem" onclick="markAll('')"><i class="fas fa-undo"></i> Reset</button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body-full">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th style="width:50px">#</th>
                                    <th style="width:60px">Roll</th>
                                    <th>Student Name</th>
                                    <th style="width:80px">Gender</th>
                                    <th>Mark Attendance</th>
                                    <th>Remarks</th>
                                    <th style="width:80px">Status</th>
                                </tr>
                            </thead>
                            <tbody id="attendance-table-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===================== FEE CREATE VIEW ===================== -->
            <div class="view" id="view-fee-create">
                <div class="page-header">
                    <div>
                        <div class="page-title">Create Fee Structure</div>
                        <div class="page-subtitle">Define & assign fees for students/classes</div>
                    </div>
                    <div class="page-actions">
                        <button class="btn-outline-custom" onclick="showView('fees')"><i class="fas fa-arrow-left"></i> Back</button>
                        <button class="btn-outline-custom" onclick="showToast('info','Draft','Fee draft saved')"><i class="fas fa-save"></i> Save Draft</button>
                        <button class="btn-primary-custom" onclick="submitFeeForm()"><i class="fas fa-check-circle"></i> Create &amp; Send</button>
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 380px;gap:20px">
                    <!-- Left: Form -->
                    <div>
                        <!-- Student / Assignment -->
                        <div class="card" style="margin-bottom:16px">
                            <div class="card-header">
                                <div class="card-title"><i class="fas fa-user-graduate me-2" style="color:var(--primary)"></i>Assignment Details</div>
                            </div>
                            <div class="card-body">
                                <div class="fee-form-section">
                                    <div class="fee-form-section-title"><i class="fas fa-sliders-h"></i> Assign To</div>
                                    <div style="display:flex;gap:8px;margin-bottom:14px">
                                        <button class="btn-primary-custom" id="fee-assign-student" style="flex:1;justify-content:center" onclick="setFeeAssign('student')"><i class="fas fa-user"></i> Individual Student</button>
                                        <button class="btn-outline-custom" id="fee-assign-class" style="flex:1;justify-content:center" onclick="setFeeAssign('class')"><i class="fas fa-users"></i> Entire Class</button>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group"><label class="form-label">Class</label>
                                            <select class="form-control-custom">
                                                <option>Class 10 — A</option>
                                                <option>Class 10 — B</option>
                                                <option>Class 9 — A</option>
                                                <option>Class 9 — B</option>
                                                <option>Class 11 — A</option>
                                                <option>Class 12 — B</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="fee-student-field"><label class="form-label">Student Name</label>
                                            <select class="form-control-custom">
                                                <option>— Select Student —</option>
                                                <option>Arjun Sharma (#STU-1248)</option>
                                                <option>Priya Gupta (#STU-1247)</option>
                                                <option>Rahul Kumar (#STU-1246)</option>
                                                <option>Sneha Das (#STU-1245)</option>
                                                <option>Mohammed Rafi (#STU-1244)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group"><label class="form-label">Academic Year</label>
                                            <select class="form-control-custom">
                                                <option>2024-25</option>
                                                <option>2025-26</option>
                                            </select>
                                        </div>
                                        <div class="form-group"><label class="form-label">Fee Term</label>
                                            <select class="form-control-custom">
                                                <option>Annual</option>
                                                <option>Term 1 (Apr–Sep)</option>
                                                <option>Term 2 (Oct–Mar)</option>
                                                <option>Monthly</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fee Items -->
                        <div class="card" style="margin-bottom:16px">
                            <div class="card-header">
                                <div class="card-title"><i class="fas fa-list-ul me-2" style="color:var(--primary)"></i>Fee Components</div>
                                <button class="btn-outline-custom" style="padding:6px 12px;font-size:.78rem" onclick="addFeeItem()"><i class="fas fa-plus"></i> Add Item</button>
                            </div>
                            <div class="card-body">
                                <div style="display:grid;grid-template-columns:1fr 140px 120px 40px;gap:10px;margin-bottom:8px;padding:0 4px">
                                    <div style="font-size:.72rem;font-weight:700;color:var(--text-secondary);text-transform:uppercase">Fee Head</div>
                                    <div style="font-size:.72rem;font-weight:700;color:var(--text-secondary);text-transform:uppercase">Amount (₹)</div>
                                    <div style="font-size:.72rem;font-weight:700;color:var(--text-secondary);text-transform:uppercase">Due Date</div>
                                    <div></div>
                                </div>
                                <div id="fee-items-container">
                                    <div class="fee-item-row" id="fee-row-1">
                                        <div><select class="form-control-custom">
                                                <option>Tuition Fee</option>
                                                <option>Transport Fee</option>
                                                <option>Library Fee</option>
                                                <option>Exam Fee</option>
                                                <option>Lab Fee</option>
                                                <option>Sports Fee</option>
                                                <option>Hostel Fee</option>
                                                <option>Miscellaneous</option>
                                            </select></div>
                                        <div><input type="number" class="form-control-custom fee-amt" placeholder="0.00" oninput="recalcTotal()" value="12500"></div>
                                        <div><input type="date" class="form-control-custom" value="2025-03-20"></div>
                                        <div><button style="width:32px;height:32px;border:1px solid var(--danger-light);background:var(--danger-light);color:var(--danger);border-radius:6px;cursor:pointer;font-size:.8rem" onclick="removeFeeItem('fee-row-1')"><i class="fas fa-trash"></i></button></div>
                                    </div>
                                    <div class="fee-item-row" id="fee-row-2">
                                        <div><select class="form-control-custom">
                                                <option value="transport">Transport Fee</option>
                                                <option>Tuition Fee</option>
                                                <option>Library Fee</option>
                                            </select></div>
                                        <div><input type="number" class="form-control-custom fee-amt" placeholder="0.00" oninput="recalcTotal()" value="3200"></div>
                                        <div><input type="date" class="form-control-custom" value="2025-03-20"></div>
                                        <div><button style="width:32px;height:32px;border:1px solid var(--danger-light);background:var(--danger-light);color:var(--danger);border-radius:6px;cursor:pointer;font-size:.8rem" onclick="removeFeeItem('fee-row-2')"><i class="fas fa-trash"></i></button></div>
                                    </div>
                                    <div class="fee-item-row" id="fee-row-3">
                                        <div><select class="form-control-custom">
                                                <option value="library">Library Fee</option>
                                                <option>Tuition Fee</option>
                                            </select></div>
                                        <div><input type="number" class="form-control-custom fee-amt" placeholder="0.00" oninput="recalcTotal()" value="800"></div>
                                        <div><input type="date" class="form-control-custom" value="2025-04-05"></div>
                                        <div><button style="width:32px;height:32px;border:1px solid var(--danger-light);background:var(--danger-light);color:var(--danger);border-radius:6px;cursor:pointer;font-size:.8rem" onclick="removeFeeItem('fee-row-3')"><i class="fas fa-trash"></i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Discount / Concession -->
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title"><i class="fas fa-tag me-2" style="color:var(--success)"></i>Discount / Concession</div>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group"><label class="form-label">Concession Type</label>
                                        <select class="form-control-custom" onchange="recalcTotal()">
                                            <option value="0">None</option>
                                            <option value="10">Merit Scholarship (10%)</option>
                                            <option value="25">Staff Ward Concession (25%)</option>
                                            <option value="50">RTE Concession (50%)</option>
                                            <option value="100">Full Scholarship (100%)</option>
                                        </select>
                                    </div>
                                    <div class="form-group"><label class="form-label">Fixed Discount (₹)</label>
                                        <input type="number" class="form-control-custom" id="fixed-discount" placeholder="0" oninput="recalcTotal()">
                                    </div>
                                </div>
                                <div class="form-group"><label class="form-label">Remarks / Note</label>
                                    <textarea class="form-control-custom" rows="2" placeholder="Optional note for this fee…" style="resize:none"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Summary -->
                    <div>
                        <div class="card" style="position:sticky;top:20px">
                            <div class="card-header">
                                <div class="card-title"><i class="fas fa-receipt me-2" style="color:var(--primary)"></i>Fee Summary</div>
                            </div>
                            <div class="card-body">
                                <div id="fee-summary-items" style="margin-bottom:16px"></div>
                                <div style="border-top:1px solid var(--border);padding-top:12px;margin-bottom:12px">
                                    <div style="display:flex;justify-content:space-between;font-size:.85rem;margin-bottom:6px"><span style="color:var(--text-secondary)">Sub Total</span><span id="fee-subtotal" style="font-weight:700">₹16,500</span></div>
                                    <div style="display:flex;justify-content:space-between;font-size:.85rem;margin-bottom:6px"><span style="color:var(--success)">Discount</span><span id="fee-discount-display" style="color:var(--success);font-weight:700">— ₹0</span></div>
                                </div>
                                <div class="fee-total-box">
                                    <div>
                                        <div class="fee-total-label">Total Payable</div>
                                        <div class="fee-total-amount" id="fee-total-display">₹16,500</div>
                                    </div>
                                    <i class="fas fa-rupee-sign" style="font-size:1.5rem;opacity:.4"></i>
                                </div>
                                <div style="margin-top:14px;display:flex;flex-direction:column;gap:8px">
                                    <div class="form-group" style="margin-bottom:0"><label class="form-label">Payment Mode</label>
                                        <select class="form-control-custom">
                                            <option>Online Payment</option>
                                            <option>Cash</option>
                                            <option>Cheque</option>
                                            <option>DD / NEFT</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-bottom:0"><label class="form-label">Notify via</label>
                                        <select class="form-control-custom">
                                            <option>SMS + Email</option>
                                            <option>SMS Only</option>
                                            <option>Email Only</option>
                                            <option>None</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin-top:14px;padding:12px;background:var(--accent-light);border-radius:var(--radius-sm);border:1px solid var(--accent);font-size:.8rem">
                                    <i class="fas fa-info-circle" style="color:var(--accent);margin-right:6px"></i>
                                    Student will receive fee challan via SMS & Email after submission.
                                </div>
                                <button class="btn-primary-custom" style="width:100%;justify-content:center;margin-top:14px" onclick="submitFeeForm()"><i class="fas fa-check-circle"></i> Create Fee &amp; Notify</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /content-inner -->
    </main>

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // ========= SUBMENU =========
        function toggleSubmenu(id, parentEl) {
            const sub = document.getElementById(id);
            const isOpen = sub.classList.contains('open');
            // close all
            document.querySelectorAll('.submenu').forEach(s => s.classList.remove('open'));
            document.querySelectorAll('.nav-item-parent').forEach(n => n.classList.remove('open'));
            if (!isOpen) {
                sub.classList.add('open');
                parentEl.classList.add('open');
            }
        }

        // ========= ATTENDANCE =========
        const classStudents = {
            '10-A': ['Arjun Sharma', 'Priya Gupta', 'Rahul Kumar', 'Sneha Das', 'Mohammed Rafi', 'Kavya Nair', 'Rohan Mehta', 'Anjali Singh', 'Vikas Tiwari', 'Deepika Rao', 'Suresh Patil', 'Nisha Joshi', 'Aakash Verma', 'Pooja Mishra', 'Ravi Shankar', 'Simran Kaur', 'Harish Nayak', 'Meera Pillai', 'Kiran Yadav', 'Tanvi Shah', 'Sachin Dubey', 'Parveen Khan', 'Lakshmi Iyer', 'Dhruv Mehta', 'Sarika Pandey', 'Ajay Srivastava', 'Nandini Gupta', 'Vishal Bhatt', 'Radhika Nair', 'Siddharth Roy', 'Preeti Sharma', 'Mohit Agarwal', 'Zara Ali', 'Aditya Kumar', 'Sunita Devi', 'Rajesh Patel', 'Ananya Bose', 'Gaurav Singh'],
            '9-B': ['Amit Sharma', 'Riya Gupta', 'Raj Patel', 'Priti Verma', 'Suraj Kumar', 'Anita Singh', 'Vivek Nair', 'Kiran Mehta', 'Sanjay Das', 'Pooja Rao', 'Deepak Joshi', 'Sunita Pillai', 'Arun Mishra', 'Lata Yadav', 'Bala Krishna', 'Meena Kaur', 'Vinod Tiwari', 'Savita Pandey', 'Ramesh Dubey', 'Geeta Khan', 'Santosh Iyer', 'Fatima Begum', 'Naresh Verma', 'Deepa Sharma', 'Mahesh Patel', 'Alka Roy', 'Rohit Mishra', 'Sushma Agarwal', 'Tarun Bhatt', 'Neeraj Nayak', 'Shilpa Kumar', 'Aryan Singh', 'Prerna Bose', 'Manish Gupta', 'Kavitha Nair', 'Raju Yadav'],
            '11-C': ['Akash Sharma', 'Divya Gupta', 'Manish Kumar', 'Ritu Singh', 'Vikas Patel', 'Sunita Verma', 'Rakesh Nair', 'Ananya Mehta', 'Sanjay Das', 'Pooja Joshi'],
            '8-A': ['Ritesh Sharma', 'Priya Nair', 'Vikram Kumar', 'Shalini Gupta', 'Arun Patel', 'Rekha Singh', 'Mohan Das', 'Lata Mehta', 'Deepak Verma', 'Sunita Joshi', 'Ramesh Rao', 'Kavitha Pillai', 'Ashok Mishra', 'Meena Yadav', 'Suresh Kaur', 'Geeta Khan', 'Narayan Iyer', 'Fatima Begum', 'Balu Naidu', 'Shanti Devi']
        };
        let attData = {};

        function renderAttendanceTable() {
            const cls = document.getElementById('att-class-sel').value;
            const students = classStudents[cls] || [];
            attData = {};
            students.forEach((s, i) => attData[i] = '');
            const tbody = document.getElementById('attendance-table-body');
            tbody.innerHTML = '';
            const genders = ['M', 'F', 'M', 'F', 'M', 'F', 'M', 'F', 'M', 'F', 'M', 'F', 'F', 'M', 'M', 'F', 'M', 'F', 'M', 'M', 'F', 'M', 'F', 'M', 'F', 'M', 'F', 'M', 'F', 'M', 'F', 'M', 'F', 'M', 'F', 'M', 'F', 'M', 'M', 'F'];
            students.forEach((name, i) => {
                const g = genders[i % genders.length];
                tbody.innerHTML += `<tr id="att-row-${i}">
      <td style="color:var(--text-secondary);font-size:.78rem">${i+1}</td>
      <td style="font-weight:600">${String(i+1).padStart(2,'0')}</td>
      <td><div style="display:flex;align-items:center;gap:8px"><div class="avatar-sm" style="background:linear-gradient(135deg,${['#3b82f6','#ec4899','#10b981','#8b5cf6','#f59e0b','#06b6d4','#ef4444'][i%7]},${['#6366f1','#f472b6','#34d399','#a78bfa','#fbbf24','#22d3ee','#f87171'][i%7]})">${name.split(' ').map(w=>w[0]).join('')}</div><strong>${name}</strong></div></td>
      <td style="text-align:center"><span style="font-size:.75rem;font-weight:600;color:var(--text-secondary)">${g==='M'?'Male':'Female'}</span></td>
      <td>
        <div style="display:flex;gap:6px;align-items:center">
          <button class="att-status-btn" id="btn-p-${i}" onclick="setAtt(${i},'present')" title="Present">P</button>
          <button class="att-status-btn" id="btn-a-${i}" onclick="setAtt(${i},'absent')" title="Absent">A</button>
          <button class="att-status-btn" id="btn-l-${i}" onclick="setAtt(${i},'late')" title="Late">L</button>
        </div>
      </td>
      <td><input class="form-control-custom" placeholder="Optional remark…" style="padding:6px 10px;font-size:.78rem"></td>
      <td><span id="att-badge-${i}" class="badge-custom badge-pending" style="min-width:60px;justify-content:center">—</span></td>
    </tr>`;
            });
            updateAttSummary();
        }

        function setAtt(idx, status) {
            attData[idx] = status;
            ['present', 'absent', 'late'].forEach(s => {
                const btn = document.getElementById(`btn-${s[0]}-${idx}`);
                if (btn) btn.className = `att-status-btn${status===s?' '+s:''}`;
            });
            const badge = document.getElementById(`att-badge-${idx}`);
            if (badge) {
                const map = {
                    present: 'badge-active',
                    absent: 'badge-inactive',
                    late: 'badge-pending',
                    '': 'badge-pending'
                };
                const label = {
                    present: 'Present',
                    absent: 'Absent',
                    late: 'Late',
                    '': '—'
                };
                badge.className = `badge-custom ${map[status]}`;
                badge.textContent = label[status];
            }
            updateAttSummary();
        }

        function markAll(status) {
            const cls = document.getElementById('att-class-sel').value;
            const count = (classStudents[cls] || []).length;
            for (let i = 0; i < count; i++) setAtt(i, status);
        }

        function updateAttSummary() {
            const vals = Object.values(attData);
            document.getElementById('att-present-count').textContent = vals.filter(v => v === 'present').length;
            document.getElementById('att-absent-count').textContent = vals.filter(v => v === 'absent').length;
            document.getElementById('att-late-count').textContent = vals.filter(v => v === 'late').length;
            document.getElementById('att-total-count').textContent = vals.length;
        }

        function saveAttendance() {
            const p = Object.values(attData).filter(v => v === 'present').length;
            const a = Object.values(attData).filter(v => v === 'absent').length;
            const l = Object.values(attData).filter(v => v === 'late').length;
            showToast('success', 'Attendance Saved', `P:${p} A:${a} L:${l} — Saved successfully!`);
        }

        // ========= FEE CREATE =========
        let feeRowCount = 3;

        function setFeeAssign(type) {
            document.getElementById('fee-assign-student').className = type === 'student' ? 'btn-primary-custom' : 'btn-outline-custom';
            document.getElementById('fee-assign-student').style.flex = '1';
            document.getElementById('fee-assign-student').style.justifyContent = 'center';
            document.getElementById('fee-assign-class').className = type === 'class' ? 'btn-primary-custom' : 'btn-outline-custom';
            document.getElementById('fee-assign-class').style.flex = '1';
            document.getElementById('fee-assign-class').style.justifyContent = 'center';
            document.getElementById('fee-student-field').style.display = type === 'student' ? 'block' : 'none';
        }

        function addFeeItem() {
            feeRowCount++;
            const id = `fee-row-${feeRowCount}`;
            const div = document.createElement('div');
            div.className = 'fee-item-row';
            div.id = id;
            div.innerHTML = `<div><select class="form-control-custom"><option>Tuition Fee</option><option>Transport Fee</option><option>Library Fee</option><option>Exam Fee</option><option>Lab Fee</option><option>Sports Fee</option><option>Hostel Fee</option><option>Miscellaneous</option></select></div><div><input type="number" class="form-control-custom fee-amt" placeholder="0.00" oninput="recalcTotal()"></div><div><input type="date" class="form-control-custom"></div><div><button style="width:32px;height:32px;border:1px solid var(--danger-light);background:var(--danger-light);color:var(--danger);border-radius:6px;cursor:pointer;font-size:.8rem" onclick="removeFeeItem('${id}')"><i class="fas fa-trash"></i></button></div>`;
            document.getElementById('fee-items-container').appendChild(div);
            recalcTotal();
        }

        function removeFeeItem(id) {
            const el = document.getElementById(id);
            if (el) {
                el.remove();
                recalcTotal();
            }
        }

        function recalcTotal() {
            const amts = document.querySelectorAll('.fee-amt');
            let sub = 0;
            amts.forEach(a => sub += parseFloat(a.value) || 0);
            const discPct = parseFloat(document.querySelector('#view-fee-create select[onchange]')?.value || 0);
            const fixedDisc = parseFloat(document.getElementById('fixed-discount')?.value || 0);
            const discAmt = Math.round(sub * discPct / 100) + fixedDisc;
            const total = Math.max(0, sub - discAmt);
            // Summary items
            const summaryEl = document.getElementById('fee-summary-items');
            if (summaryEl) {
                const rows = document.querySelectorAll('.fee-item-row');
                let html = '';
                rows.forEach(r => {
                    const sel = r.querySelector('select');
                    const amt = r.querySelector('.fee-amt');
                    if (sel && amt && parseFloat(amt.value)) {
                        html += `<div style="display:flex;justify-content:space-between;font-size:.85rem;padding:6px 0;border-bottom:1px solid var(--border)"><span style="color:var(--text-secondary)">${sel.value}</span><span style="font-weight:600">₹${parseInt(amt.value).toLocaleString('en-IN')}</span></div>`;
                    }
                });
                summaryEl.innerHTML = html || '<div style="color:var(--text-secondary);font-size:.85rem;text-align:center;padding:10px">No fee items added</div>';
            }
            const subtotalEl = document.getElementById('fee-subtotal');
            const discEl = document.getElementById('fee-discount-display');
            const totalEl = document.getElementById('fee-total-display');
            if (subtotalEl) subtotalEl.textContent = `₹${sub.toLocaleString('en-IN')}`;
            if (discEl) discEl.textContent = `— ₹${discAmt.toLocaleString('en-IN')}`;
            if (totalEl) totalEl.textContent = `₹${total.toLocaleString('en-IN')}`;
        }

        function submitFeeForm() {
            showToast('success', 'Fee Created', 'Fee structure created & student notified via SMS/Email!');
            setTimeout(() => showView('fees'), 600);
        }

        // ========= LOADER =========
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('page-loader').classList.add('hide');
                initCalendar();
                populateTables();
                // set today's date on attendance
                const today = new Date().toISOString().split('T')[0];
                const attDate = document.getElementById('att-date');
                if (attDate) attDate.value = today;
                renderAttendanceTable();
                recalcTotal();
                showToast('success', 'Welcome', 'EduCore ERP loaded successfully!');
            }, 2200);
        });

        // ========= SIDEBAR =========
        let sidebarCollapsed = false;

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const isMobile = window.innerWidth < 992;
            if (isMobile) {
                sidebar.classList.toggle('mobile-open');
                document.getElementById('sidebar-overlay').classList.toggle('show');
            } else {
                sidebarCollapsed = !sidebarCollapsed;
                sidebar.classList.toggle('collapsed', sidebarCollapsed);
            }
        }

        function closeMobileSidebar() {
            document.getElementById('sidebar').classList.remove('mobile-open');
            document.getElementById('sidebar-overlay').classList.remove('show');
        }

        // ========= VIEW NAVIGATION =========
        function showView(id) {
            document.querySelectorAll('.view').forEach(v => v.classList.remove('active'));
            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            const v = document.getElementById('view-' + id);
            if (v) v.classList.add('active');
            document.querySelectorAll('.nav-item').forEach(n => {
                if (n.getAttribute('onclick') && n.getAttribute('onclick').includes("'" + id + "'")) n.classList.add('active');
            });
            closeMobileSidebar();
            document.getElementById('main-content').scrollTop = 0;
            if (id === 'attendance') renderAttendanceTable();
            if (id === 'fee-create') recalcTotal();
        }

        // ========= ROLE SWITCHER =========
        function switchRole(role, btn) {
            document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const icons = {
                admin: '👑',
                teacher: '📚',
                student: '🎓'
            };
            const names = {
                admin: 'Admin User',
                teacher: 'Mr. R. Sharma',
                student: 'Arjun Sharma'
            };
            const roles = {
                admin: 'Super Admin',
                teacher: 'Class Teacher',
                student: 'Class 10-A'
            };
            document.querySelectorAll('.topbar-profile-name').forEach(el => el.textContent = names[role]);
            document.querySelectorAll('.topbar-profile-role').forEach(el => el.textContent = roles[role]);
            document.querySelectorAll('.sidebar-user-name').forEach(el => el.textContent = names[role]);
            document.querySelectorAll('.sidebar-user-role').forEach(el => el.textContent = roles[role]);
            showToast('success', 'Role Switched', `Now viewing as: ${names[role]}`);
        }

        // ========= TOAST =========
        let toastCount = 0;

        function showToast(type, title, msg) {
            const icons = {
                success: 'fa-check',
                danger: 'fa-times',
                warning: 'fa-exclamation',
                info: 'fa-info'
            };
            const toaster = document.getElementById('toaster');
            const t = document.createElement('div');
            t.className = `toast-item toast-${type}`;
            t.innerHTML = `<div class="toast-icon"><i class="fas ${icons[type]||icons.info}"></i></div><div><div class="toast-msg">${title}</div><div class="toast-sub">${msg}</div></div><i class="fas fa-times toast-close"></i>`;
            toaster.appendChild(t);
            t.querySelector('.toast-close').onclick = () => removeToast(t);
            requestAnimationFrame(() => {
                requestAnimationFrame(() => t.classList.add('show'));
            });
            setTimeout(() => removeToast(t), 4000);
        }

        function removeToast(t) {
            t.classList.remove('show');
            setTimeout(() => t.remove(), 400);
        }

        // ========= CALENDAR =========
        function initCalendar() {
            const now = new Date();
            renderCalendar(now.getFullYear(), now.getMonth());
        }
        let calYear, calMonth;

        function renderCalendar(year, month) {
            calYear = year;
            calMonth = month;
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const days = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
            const today = new Date();
            const eventDays = [4, 8, 14, 15, 20, 22, 27];
            const first = new Date(year, month, 1).getDay();
            const total = new Date(year, month + 1, 0).getDate();
            const prevTotal = new Date(year, month, 0).getDate();
            let html = `<div class="calendar-nav"><button class="cal-btn" onclick="renderCalendar(${month===0?year-1:year},${month===0?11:month-1})"><i class="fas fa-chevron-left"></i></button><span class="calendar-month">${months[month]} ${year}</span><button class="cal-btn" onclick="renderCalendar(${month===11?year+1:year},${month===11?0:month+1})"><i class="fas fa-chevron-right"></i></button></div><div class="cal-grid">`;
            days.forEach(d => html += `<div class="cal-day-label">${d}</div>`);
            for (let i = 0; i < first; i++) html += `<div class="cal-day other-month">${prevTotal-first+1+i}</div>`;
            for (let i = 1; i <= total; i++) {
                const isToday = i === today.getDate() && month === today.getMonth() && year === today.getFullYear();
                const hasEv = eventDays.includes(i);
                html += `<div class="cal-day${isToday?' today':''}${hasEv&&!isToday?' has-event':''}" onclick="showToast('info','${months[month]} ${i}','${hasEv?'Event scheduled':'No events'}')">${i}</div>`;
            }
            const remaining = 42 - first - total;
            for (let i = 1; i <= remaining; i++) html += `<div class="cal-day other-month">${i}</div>`;
            html += '</div>';
            document.getElementById('cal-widget').innerHTML = html;
        }

        // ========= POPULATE TABLES =========
        function populateTables() {
            const students = [
                ['STU-1248', 'Arjun Sharma', '10-A', 'Raj Sharma', '9876543210', 'Paid'],
                ['STU-1247', 'Priya Gupta', '9-B', 'Anita Gupta', '9765432109', 'Paid'],
                ['STU-1246', 'Rahul Kumar', '11-C', 'Suresh Kumar', '9654321098', 'Pending'],
                ['STU-1245', 'Sneha Das', '8-A', 'Mohan Das', '9543210987', 'Paid'],
                ['STU-1244', 'Mohammed Rafi', '12-B', 'Abdul Rafi', '9432109876', 'Overdue'],
                ['STU-1243', 'Kavya Nair', '7-A', 'Lakshmi Nair', '9321098765', 'Paid'],
                ['STU-1242', 'Rohan Mehta', '10-C', 'Vijay Mehta', '9210987654', 'Pending'],
            ];
            const feeColors = ['#3b82f6', '#ec4899', '#10b981', '#8b5cf6', '#f59e0b', '#06b6d4', '#ef4444'];
            const stb = document.getElementById('students-table-body');
            if (stb) students.forEach((s, i) => {
                const initials = s[1].split(' ').map(w => w[0]).join('');
                const feeClass = s[5] === 'Paid' ? 'badge-paid' : s[5] === 'Pending' ? 'badge-pending' : 'badge-inactive';
                stb.innerHTML += `<tr><td style="font-size:.78rem;color:var(--text-secondary)">#${s[0]}</td><td><div style="display:flex;align-items:center;gap:8px"><div class="avatar-sm" style="background:linear-gradient(135deg,${feeColors[i%7]},${feeColors[(i+1)%7]})">${initials}</div><strong>${s[1]}</strong></div></td><td><span class="badge-custom badge-primary">${s[2]}</span></td><td style="font-size:.82rem">${s[3]}</td><td style="font-size:.78rem;color:var(--text-secondary)">${s[4]}</td><td><span class="badge-custom ${feeClass}">${s[5]}</span></td><td><span class="badge-custom badge-active">Active</span></td><td><button class="btn-outline-custom" style="padding:4px 10px;font-size:.75rem" onclick="showToast('info','Student','Viewing ${s[1]}\'s profile')"><i class="fas fa-eye"></i></button></td></tr>`;
            });

            const teachers = [
                ['TCH-001', 'Rajesh Sharma', 'Mathematics', '10-A, 10-B', '15 years'],
                ['TCH-002', 'Sunita Verma', 'English', '9-A, 9-B, 9-C', '12 years'],
                ['TCH-003', 'Anil Kumar', 'Science', '10-C, 11-A', '10 years'],
                ['TCH-004', 'Priya Singh', 'Hindi', '8-A, 8-B, 8-C', '8 years'],
                ['TCH-005', 'Mukesh Gupta', 'Computer Science', '9-D, 10-A, 11-B', '6 years'],
                ['TCH-006', 'Deepa Nair', 'Social Studies', '7-A, 8-A', '14 years'],
            ];
            const ttb = document.getElementById('teachers-table-body');
            if (ttb) teachers.forEach((t, i) => {
                const initials = t[1].split(' ').map(w => w[0]).join('');
                ttb.innerHTML += `<tr><td style="font-size:.78rem;color:var(--text-secondary)">#${t[0]}</td><td><div style="display:flex;align-items:center;gap:8px"><div class="avatar-sm" style="background:linear-gradient(135deg,${feeColors[i%7]},${feeColors[(i+2)%7]})">${initials}</div><strong>${t[1]}</strong></div></td><td>${t[2]}</td><td style="font-size:.8rem">${t[3]}</td><td style="font-size:.82rem">${t[4]}</td><td><span class="badge-custom badge-active">Active</span></td><td><button class="btn-outline-custom" style="padding:4px 10px;font-size:.75rem" onclick="showToast('info','Teacher','Viewing ${t[1]}\'s profile')"><i class="fas fa-eye"></i></button></td></tr>`;
            });

            const fees = [
                ['RCP-2024', 'Arjun Sharma', '10-A', 'Tuition Fee', '₹12,500', 'Mar 15', 'Mar 2', 'Paid'],
                ['RCP-2023', 'Priya Gupta', '9-B', 'Tuition Fee', '₹12,500', 'Mar 15', 'Mar 1', 'Paid'],
                ['RCP-2022', 'Rahul Kumar', '11-C', 'Transport Fee', '₹3,200', 'Mar 10', '—', 'Pending'],
                ['RCP-2021', 'Sneha Das', '8-A', 'Tuition Fee', '₹11,000', 'Mar 15', 'Feb 28', 'Paid'],
                ['RCP-2020', 'Mohammed Rafi', '12-B', 'Exam Fee', '₹2,500', 'Feb 28', '—', 'Overdue'],
                ['RCP-2019', 'Kavya Nair', '7-A', 'Library Fee', '₹800', 'Mar 20', 'Mar 4', 'Paid'],
            ];
            const ftb = document.getElementById('fees-table-body');
            if (ftb) fees.forEach((f, i) => {
                const sc = f[7] === 'Paid' ? 'badge-paid' : f[7] === 'Pending' ? 'badge-pending' : 'badge-inactive';
                ftb.innerHTML += `<tr><td style="font-size:.78rem"><strong>${f[0]}</strong></td><td><div style="display:flex;align-items:center;gap:8px"><div class="avatar-sm" style="background:linear-gradient(135deg,${feeColors[i%7]},${feeColors[(i+3)%7]})">${f[1].split(' ').map(w=>w[0]).join('')}</div><strong>${f[1]}</strong></div></td><td><span class="badge-custom badge-primary">${f[2]}</span></td><td style="font-size:.82rem">${f[3]}</td><td style="font-weight:700">${f[4]}</td><td style="font-size:.8rem;color:var(--text-secondary)">${f[5]}</td><td style="font-size:.8rem;color:var(--text-secondary)">${f[6]}</td><td><span class="badge-custom ${sc}">${f[7]}</span></td><td><button class="btn-outline-custom" style="padding:4px 10px;font-size:.75rem" onclick="showToast('success','Receipt','Downloading receipt…')"><i class="fas fa-download"></i></button></td></tr>`;
            });

            const invs = [
                ['INV-312', 'Arjun Sharma', '10-A', 'Mar 1', 'Mar 15', '₹12,500', 'Paid'],
                ['INV-311', 'Priya Gupta', '9-B', 'Mar 1', 'Mar 15', '₹12,500', 'Paid'],
                ['INV-310', 'Rahul Kumar', '11-C', 'Feb 25', 'Mar 10', '₹15,700', 'Pending'],
                ['INV-309', 'Sneha Das', '8-A', 'Feb 20', 'Mar 5', '₹11,800', 'Paid'],
                ['INV-308', 'Mohammed Rafi', '12-B', 'Feb 15', 'Feb 28', '₹15,000', 'Overdue'],
                ['INV-307', 'Kavya Nair', '7-A', 'Feb 10', 'Feb 25', '₹9,300', 'Paid'],
                ['INV-306', 'Rohan Mehta', '10-C', 'Feb 5', 'Feb 20', '₹12,500', 'Pending'],
            ];

            const itb = document.getElementById('invoices-table-body');
            if (itb) invs.forEach((inv, i) => {
                const sc = inv[6] === 'Paid' ? 'badge-paid' : inv[6] === 'Pending' ? 'badge-pending' : 'badge-inactive';
                itb.innerHTML += `<tr><td style="font-size:.78rem"><strong>${inv[0]}</strong></td><td><div style="display:flex;align-items:center;gap:8px"><div class="avatar-sm" style="background:linear-gradient(135deg,${feeColors[i%7]},${feeColors[(i+4)%7]})">${inv[1].split(' ').map(w=>w[0]).join('')}</div><strong>${inv[1]}</strong></div></td><td><span class="badge-custom badge-primary">${inv[2]}</span></td><td style="font-size:.8rem;color:var(--text-secondary)">${inv[3]}</td><td style="font-size:.8rem;color:var(--text-secondary)">${inv[4]}</td><td style="font-weight:700">${inv[5]}</td><td><span class="badge-custom ${sc}">${inv[6]}</span></td><td><button class="btn-outline-custom" style="padding:4px 10px;font-size:.75rem" onclick="showToast('success','Invoice','Downloading invoice…')"><i class="fas fa-download"></i></button></td></tr>`;
            });
        }
    </script>
</body>