
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>
  </head>
  <body style="height:100vh !important;">
  
    <footer class="shadow border-top w-100 position-relative bottom-0 start-0 mt-5" >
      <div class="container">
        <p class="text-center text-body-secondary">&copy; 2024 ITI - JOB _ Bord</p>
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
        </ul>
        <!-- <ul class="nav justify-content-center">
          <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Twitter</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Facebook</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Instagram</a></li>
        </ul> -->
      </div>
    </footer>

    <button id="theme-toggle" class="btn btn-outline-secondary position-fixed bottom-0 end-0 m-3">
      <svg class="bi" width="24" height="24" role="img" aria-label="Toggle theme">
        <use xlink:href="#moon-stars-fill"/>
      </svg>
      <span class="visually-hidden">Toggle theme</span>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      const themeToggleButton = document.getElementById('theme-toggle');
      const currentTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-bs-theme', currentTheme);

      themeToggleButton.addEventListener('click', () => {
        const newTheme = document.documentElement.getAttribute('data-bs-theme') === 'light' ? 'dark' : 'light';
        document.documentElement.setAttribute('data-bs-theme', newTheme);
        localStorage.setItem('theme', newTheme);
      });
    </script>
    <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M9.236 12.668a6.5 6.5 0 1 0 .693-12.936A7.006 7.006 0 0 1 8 0a7 7 0 0 0 0 14c.363 0 .719-.036 1.066-.104a6.471 6.471 0 0 0 0 .772zM9.234 1.314a5.501 5.501 0 0 1 .665 8.863 5.517 5.517 0 0 1-1.313-.354A5.5 5.5 0 0 1 9.234 1.313z"/>
      </symbol>
      <symbol id="bootstrap" viewBox="0 0 16 16">
        <path d="M3.5 1.5A1.5 1.5 0 0 1 5 0h6a1.5 1.5 0 0 1 1.5 1.5V14.5A1.5 1.5 0 0 1 11 16H5a1.5 1.5 0 0 1-1.5-1.5V1.5zM4.5 1v14h7V1h-7z"/>
      </symbol>
    </svg>
   