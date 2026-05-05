            </main>
        </div>
    </div>
    
    <script>
        // Dashboard Theme Toggle Logic
        const themeToggle = document.getElementById('theme-toggle');
        const rootElement = document.documentElement;
        
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            rootElement.setAttribute('data-theme', savedTheme);
            if(savedTheme === 'dark') themeToggle.textContent = '☀️';
        }

        themeToggle.addEventListener('click', () => {
            const currentTheme = rootElement.getAttribute('data-theme');
            if (currentTheme === 'dark') {
                rootElement.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
                themeToggle.textContent = '🌙';
            } else {
                rootElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                themeToggle.textContent = '☀️';
            }
        });
    </script>
</body>
</html>
