<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style type="text/css">
#footer {
    font-size: 0.8em;
}
</style>


<script type="text/javascript">
    function changeTheme(theme, cookie=true) {
      if (theme === 'dark') {
        document.documentElement.setAttribute('data-bs-theme','dark');
        if(cookie) localStorage.setItem("theme","dark");
      } else if(theme == 'light'){
        document.documentElement.setAttribute('data-bs-theme','light');
        if(cookie) localStorage.setItem("theme","light");
      } else {
        // auto
        localStorage.removeItem("theme");
        readThemePreference();
      }
    }

    function isDark() {
        // yes this is a hack
        return document.documentElement.getAttribute('data-bs-theme') == 'dark';
    }

    function readThemePreference() {
        // Apply the theme based on user's preference from a cookie (if available)
        const userThemePreference = localStorage.getItem('theme');
        if (userThemePreference) {
            changeTheme(userThemePreference);
        } else {
            // Check for OS-level preference (light/dark mode)
            const prefersDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (prefersDarkMode) {
                changeTheme('dark', false);
            } else {
                const prefersLightMode = window.matchMedia('(prefers-color-scheme: light)').matches;
                if (prefersLightMode) {
                    changeTheme('light', false);
                } else {
                    // no preference, default to light
                    changeTheme('light',false);
                    localStorage.removeItem("theme");
                }
            }
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        readThemePreference();
    });
</script>
