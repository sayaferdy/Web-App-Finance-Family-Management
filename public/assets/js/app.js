const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebarOverlay');

if(mobileMenuBtn){

    mobileMenuBtn.addEventListener('click', () => {

        sidebar.classList.add('show');
        overlay.classList.add('show');

    });

}

if(overlay){

    overlay.addEventListener('click', () => {

        sidebar.classList.remove('show');
        overlay.classList.remove('show');

    });

}