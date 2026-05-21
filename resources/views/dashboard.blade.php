<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registry Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
            <span class="refresh-badge" id="liveStatus">Live updates · no page reload</span>
            <span id="lastUpdated">—</span>
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
                <strong>Projects health</strong>
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

<script src="{{ asset('js/dashboard.js') }}" defer></script>

</body>
</html>
