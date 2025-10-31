<style>
  /* === NAVBAR STYLING (centered perfectly) === */
  .header-area {
      background-color: #2c3e50 !important;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999;
    transition: all 0.3s ease;
    padding: 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }


  /* Prevent any white sliver under the bar */
  .header-area,
  .header-area * {
    box-sizing: border-box;
  }

  .header-area .container {
    padding: 0 16px;
  }

  /* Make the bar a flex row and lock the height */
  .header-area .main-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0;
    min-height: 70px;
    height: 70px;
    gap: 16px;
  }

  /* Left: logo */
  .header-area .main-nav .logo {
    text-decoration: none;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    height: 100%;
  }

  .header-area .main-nav .logo h1 {
    font-size: 24px;
    font-weight: 700;
    color: #fff;
    margin: 0;
    text-transform: uppercase;
    line-height: 1;
  }

  /* Center: menu */
  .header-area .main-nav ul.nav {
    display: flex;
    align-items: center;
    gap: 6px;
    list-style: none;
    margin: 0;
    padding: 0;
    height: 100%;
  }

  .header-area .main-nav ul.nav li {
    position: relative;
    height: 100%;
    display: flex;
    align-items: center;
  }

  /* Make each anchor the same height as the bar, content centered */
  .header-area .main-nav ul.nav li a {
    color: #ecf0f1 !important;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    padding: 0 14px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.25s ease;
    border-radius: 8px;
  }

  .header-area .main-nav ul.nav li a:hover {
    color: #fff !important;
    background: rgba(255, 255, 255, 0.1);
  }

  .header-area .main-nav ul.nav li a.active {
    color: #fff !important;
    background: rgba(52, 152, 219, 0.2);
  }

  /* === DROPDOWN STYLES (FIXED) === */
  .header-area .nav-item.dropdown {
    position: relative;
  }

  .header-area .nav-item.dropdown .nav-link {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #ecf0f1 !important;
    padding: 0 12px !important;
    height: 44px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    cursor: pointer;
  }

  .header-area .nav-item.dropdown .nav-link::after {
    content: "▾";
    margin-left: 4px;
    font-size: 12px;
    line-height: 1;
  }

  /* DROPDOWN MENU - FIX POSITIONING */
  .header-area .dropdown-menu {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
    padding: 8px 0;
    margin-top: 8px;
    border: 1px solid #e0e0e0;
    min-width: 180px;
    display: none; /* Default hidden */
    position: absolute;
    top: 100%; /* Position below the toggle */
    right: 0;
    left: auto;
    z-index: 9999; /* Higher z-index */
  }

  /* SHOW CLASS - IMPORTANT */
  .header-area .dropdown-menu.show {
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
  }

  .header-area .dropdown-header {
    padding: 8px 12px;
    font-weight: 600;
    color: #2c3e50;
    font-size: 12px;
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
  }

  .header-area .dropdown-item {
    padding: 9px 12px;
    color: #555;
    font-size: 13px;
    text-decoration: none;
    display: flex;
    align-items: center;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
    transition: background 0.2s;
  }

  .header-area .dropdown-item i {
    margin-right: 8px;
    width: 14px;
    font-size: 12px;
    color: #666 !important;
  }

  .header-area .dropdown-item:hover {
    background: #f4f6f8;
    color: #333 !important;
  }

  .header-area .dropdown-item:hover i {
    color: #333 !important;
  }

  .header-area .dropdown-item.text-danger {
    color: #333333 !important;
    background: transparent !important;
    transition: all 0.3s ease;
  }

  .header-area .dropdown-item.text-danger i {
    color: #dc3545 !important;
    transition: all 0.3s ease
  }

  .header-area .dropdown-item.text-danger:hover {
     background: #dc3545 !important;
    color: #ffffff !important;
    transform: translateX(5px);
  }

  .header-area .dropdown-item.text-danger:hover i {
    color: #fff !important; /* White icon saat hover */
  }

  .header-area .dropdown-divider {
    margin: 4px 0;
    border-top: 1px solid #e9ecef;
  }

  /* Right: auth buttons */
  .header-area .auth-links {
    display: flex;
    align-items: center;
    gap: 10px;
    height: 100%;
  }

  .header-area .auth-links a {
    color: #ecf0f1 !important;
    text-decoration: none;
    font-size: 13px;
    height: 44px;
    padding: 0 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: all 0.25s ease;
    line-height: 1;
  }

  .header-area .auth-links a:first-child {
    background: rgba(52, 152, 219, 0.18);
    border: 1px solid rgba(52, 152, 219, 0.35);
  }

  .header-area .auth-links a:first-child:hover {
    background: #3498db;
  }

  .header-area .auth-links a:last-child {
    background: rgba(46, 204, 113, 0.18);
    border: 1px solid rgba(46, 204, 113, 0.35);
  }

  .header-area .auth-links a:last-child:hover {
    background: #2ecc71;
  }

  .header-area .auth-links .separator {
    color: rgba(255, 255, 255, 0.35);
    align-self: center;
  }

  /* Mobile Menu Trigger */
  .header-area .menu-trigger {
    display: none;
    flex-direction: column;
    cursor: pointer;
    padding: 6px;
    background: rgba(255, 255, 255, 0.12);
    border: none;
    border-radius: 6px;
  }

  .header-area .menu-trigger span {
    width: 20px;
    height: 2px;
    background: #fff;
    margin: 3px 0;
    transition: 0.3s;
  }

  /* Mobile */
  @media (max-width: 768px) {
    .header-area .menu-trigger {
      display: flex;
    }

    .header-area .main-nav {
      height: 64px;
      min-height: 64px;
    }

    .header-area .main-nav ul.nav {
      position: absolute;
      top: 100%;
      left: 0;
      width: 100%;
      background: #2c3e50;
      flex-direction: column;
      padding: 14px;
      gap: 10px;
      display: none;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .header-area .main-nav ul.nav.active {
      display: flex;
    }

    .header-area .dropdown-menu {
      position: static;
      margin-top: 10px;
      width: 100%;
    }

    /* Make touch targets slightly larger */
    .header-area .main-nav ul.nav li a,
    .header-area .nav-item.dropdown .nav-link,
    .header-area .auth-links a {
      height: 46px;
    }
  }

  /* Username truncation */
  .username {
    max-width: 120px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  /* === FORCE DROPDOWN TEXT COLOR (SUPER IMPORTANT) === */
  .header-area .dropdown-menu .dropdown-header,
  .header-area .dropdown-menu .dropdown-header * {
    color: #2c3e50 !important;
  }

  .header-area .dropdown-menu .dropdown-item:not(.text-danger),
  .header-area .dropdown-menu .dropdown-item:not(.text-danger) * {
    color: #333333 !important;
  }

  .header-area .dropdown-menu .dropdown-item:not(.text-danger):hover,
  .header-area .dropdown-menu .dropdown-item:not(.text-danger):hover * {
    color: #000000 !important;
  }

  .header-area .dropdown-menu .dropdown-item.text-danger,
  .header-area .dropdown-menu .dropdown-item.text-danger * {
    color: #dc3545 !important;
  }

  .header-area .dropdown-menu .dropdown-item.text-danger:hover,
  .header-area .dropdown-menu .dropdown-item.text-danger:hover * {
     color: #ffffff !important;
  }

  /* Specific untuk icon */
  .header-area .dropdown-menu .dropdown-item:not(.text-danger) i {
    color: #666666 !important;
  }

  .header-area .dropdown-menu .dropdown-item:not(.text-danger):hover i {
    color: #000000 !important;
  }

  .header-area .dropdown-menu .dropdown-item.text-danger i {
    color: #dc3545 !important;
  }

  .header-area .dropdown-menu .dropdown-item.text-danger:hover i {
    color: #ffffff !important;
  }
</style>

