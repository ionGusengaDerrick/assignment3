<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registry Dashboard</title>

    <style>
        :root {
            --sidebar: #0f172a;
            --sidebar-text: #94a3b8;
            --sidebar-active: #ffffff;
            --bg: #f1f5f9;
            --surface: #ffffff;
            --text: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --accent: #3b82f6;
            --accent-soft: #eff6ff;
            --online: #16a34a;
            --online-bg: #dcfce7;
            --offline: #dc2626;
            --offline-bg: #fee2e2;
            --warn: #d97706;
            --warn-bg: #fef3c7;
            --shadow: 0 1px 2px rgba(15, 23, 42, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(15, 23, 42, 0.07), 0 2px 4px -2px rgba(15, 23, 42, 0.05);
            --radius: 12px;
            --sidebar-width: 240px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.5;
            min-height: 100vh;
            display: flex;
        }

        /* —— Sidebar —— */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar);
            color: var(--sidebar-text);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .sidebar-brand {
            padding: 1.35rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-brand h2 {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--sidebar-active);
            letter-spacing: -0.02em;
        }

        .sidebar-brand span {
            display: block;
            font-size: 0.7rem;
            margin-top: 0.2rem;
            color: var(--sidebar-text);
        }

        .sidebar-nav {
            padding: 1rem 0.75rem;
            flex: 1;
        }

        .nav-label {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 0 0.5rem;
            margin-bottom: 0.5rem;
            color: #475569;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.6rem 0.75rem;
            border-radius: 8px;
            font-size: 0.875rem;
            color: var(--sidebar-text);
            text-decoration: none;
        }

        .nav-item.active {
            background: rgba(59, 130, 246, 0.15);
            color: var(--sidebar-active);
        }

        .nav-item svg {
            width: 18px;
            height: 18px;
            opacity: 0.85;
        }

        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            font-size: 0.75rem;
        }

        .live-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: #86efac;
        }

        .live-pill::before {
            content: "";
            width: 7px;
            height: 7px;
            background: #22c55e;
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.5); }
            50% { opacity: 0.7; box-shadow: 0 0 0 6px rgba(34, 197, 94, 0); }
        }

        /* —— Main —— */
        .main {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 1rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: var(--shadow);
        }

        .topbar h1 {
            font-size: 1.25rem;
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        .topbar-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .refresh-badge {
            background: var(--accent-soft);
            color: var(--accent);
            padding: 0.3rem 0.75rem;
            border-radius: 999px;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .content {
            padding: 1.5rem 1.75rem 2rem;
            flex: 1;
        }

        /* —— Stat cards —— */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                min-height: unset;
            }
            .stats { grid-template-columns: 1fr; }
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.15rem 1.25rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 0.75rem;
        }

        .stat-card .label {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .stat-card .value {
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.03em;
            margin-top: 0.25rem;
            line-height: 1.1;
        }

        .stat-card .hint {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 0.35rem;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon svg { width: 22px; height: 22px; }

        .stat-icon.total { background: var(--accent-soft); color: var(--accent); }
        .stat-icon.online { background: var(--online-bg); color: var(--online); }
        .stat-icon.offline { background: var(--offline-bg); color: var(--offline); }

        /* —— Health bar —— */
        .health-panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.15rem 1.25rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow);
        }

        .health-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.65rem;
            font-size: 0.85rem;
        }

        .health-header strong { font-weight: 600; }

        .health-bar {
            height: 8px;
            background: #e2e8f0;
            border-radius: 999px;
            overflow: hidden;
        }

        .health-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--online), #4ade80);
            border-radius: 999px;
            transition: width 0.4s ease;
            min-width: 0;
        }

        /* —— Services panel —— */
        .panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .panel-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .panel-header h3 {
            font-size: 0.95rem;
            font-weight: 600;
        }

        .panel-header span {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .table-wrap { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; }

        thead { background: #f8fafc; }

        th {
            text-align: left;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 0.9rem 1.25rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.875rem;
        }

        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: #f8fafc; }

        .project-tag {
            display: inline-block;
            background: #f1f5f9;
            border: 1px solid var(--border);
            padding: 0.2rem 0.55rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        td a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        td a:hover { text-decoration: underline; }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
        }

        .badge::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .badge.online { color: var(--online); background: var(--online-bg); }
        .badge.online::before { background: var(--online); }
        .badge.offline { color: var(--offline); background: var(--offline-bg); }
        .badge.offline::before { background: var(--offline); }

        .empty {
            padding: 3.5rem 1.5rem;
            text-align: center;
            color: var(--text-muted);
        }

        .empty-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 1rem;
            background: #f1f5f9;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
        }

        .empty strong {
            display: block;
            color: var(--text);
            font-size: 0.95rem;
            margin-bottom: 0.35rem;
        }

        .empty code {
            background: #f1f5f9;
            padding: 0.15rem 0.4rem;
            border-radius: 4px;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">
        <h2>Service Registry</h2>
        <span>Discovery &amp; monitoring</span>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-label">Menu</div>
        <a href="#" class="nav-item active">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Overview
        </a>
        <a href="#" class="nav-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>
            Services
        </a>
    </nav>
    <div class="sidebar-footer">
        <div class="live-pill">Live monitoring</div>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <h1>Dashboard</h1>
        <div class="topbar-meta">
            <span class="refresh-badge">Auto-refresh · 3s</span>
            <span>Updated <strong id="lastUpdated">—</strong></span>
        </div>
    </header>

    <div class="content">
        <section class="stats">
            <div class="stat-card">
                <div>
                    <div class="label">Total services</div>
                    <div class="value" id="statTotal">0</div>
                    <div class="hint">Registered in registry</div>
                </div>
                <div class="stat-icon total">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="label">Online</div>
                    <div class="value" id="statOnline" style="color: var(--online)">0</div>
                    <div class="hint">Active within 10s</div>
                </div>
                <div class="stat-icon online">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="label">Offline</div>
                    <div class="value" id="statOffline" style="color: var(--offline)">0</div>
                    <div class="hint">No recent ping</div>
                </div>
                <div class="stat-icon offline">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                </div>
            </div>
        </section>

        <section class="health-panel">
            <div class="health-header">
                <strong>Fleet health</strong>
                <span id="healthPercent">0% online</span>
            </div>
            <div class="health-bar">
                <div class="health-fill" id="healthFill" style="width: 0%"></div>
            </div>
        </section>

        <section class="panel">
            <div class="panel-header">
                <h3>Registered services</h3>
                <span id="serviceCount">0 services</span>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Status</th>
                            <th>Service name</th>
                            <th>Endpoint</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody"></tbody>
                </table>
            </div>
            <div id="emptyState" class="empty" style="display: none;">
                <div class="empty-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                </div>
                <strong>No services yet</strong>
                Waiting for apps to register via <code>POST /register</code>
            </div>
        </section>
    </div>
</div>

<script>

async function loadServices() {

    const response = await fetch('/services');
    const services = await response.json();
    const keys = Object.keys(services);

    let online = 0;
    let offline = 0;

    for (const key of keys) {
        if (services[key].status === 'Online') online++;
        else offline++;
    }

    const total = keys.length;
    const pct = total ? Math.round((online / total) * 100) : 0;

    document.getElementById('statTotal').textContent = total;
    document.getElementById('statOnline').textContent = online;
    document.getElementById('statOffline').textContent = offline;
    document.getElementById('healthPercent').textContent = pct + '% online';
    document.getElementById('healthFill').style.width = pct + '%';
    document.getElementById('serviceCount').textContent =
        total + (total === 1 ? ' service' : ' services');

    const tbody = document.getElementById('tableBody');
    const emptyState = document.getElementById('emptyState');
    const tableWrap = document.querySelector('.table-wrap');

    if (total === 0) {
        tbody.innerHTML = '';
        emptyState.style.display = 'block';
        tableWrap.style.display = 'none';
    } else {
        emptyState.style.display = 'none';
        tableWrap.style.display = 'block';

        let rows = '';

        for (const key of keys) {
            const s = services[key];
            const isOnline = s.status === 'Online';

            rows += `
                <tr>
                    <td><span class="project-tag">${s.project}</span></td>
                    <td>
                        <span class="badge ${isOnline ? 'online' : 'offline'}">${s.status}</span>
                    </td>
                    <td>${s.name}</td>
                    <td>
                        <a href="${s.url}" target="_blank" rel="noopener noreferrer">${s.url}</a>
                    </td>
                </tr>
            `;
        }

        tbody.innerHTML = rows;
    }

    document.getElementById('lastUpdated').textContent =
        new Date().toLocaleTimeString();
}

loadServices();
setInterval(loadServices, 3000);

</script>

</body>
</html>
