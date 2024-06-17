<div id="logo-container">
    <img
        id="logo-dark"
        src="https://jobtrek.ch/wp-content/themes/jobtrek-theme/static/img/logo-white.svg"
        class="h-11 hidden dark:block"
        alt="logo jobtrek"
    >
    <img
        id="logo-light"
        src="https://jobtrek.ch/wp-content/themes/jobtrek-theme/static/img/logo-black.svg"
        class="h-11 block dark:hidden"
        alt="logo jobtrek"
    >
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoDark = document.getElementById('logo-dark');
        const logoLight = document.getElementById('logo-light');

        const updateLogo = () => {
            if (document.documentElement.classList.contains('dark')) {
                logoDark.classList.remove('hidden');
                logoLight.classList.add('hidden');
            } else {
                logoDark.classList.add('hidden');
                logoLight.classList.remove('hidden');
            }
        };

        updateLogo();

        const observer = new MutationObserver(updateLogo);
        observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
    });
</script>

