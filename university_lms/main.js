// main.js

// 1. Auth Toggle Logic
function toggleAuth() {
    const loginCard = document.getElementById('login-card');
    const registerCard = document.getElementById('register-card');
    
    if (loginCard.classList.contains('hidden')) {
        loginCard.classList.remove('hidden');
        registerCard.classList.add('hidden');
    } else {
        loginCard.classList.add('hidden');
        registerCard.classList.remove('hidden');
    }
}

// 2. Fee Banner Logic (Student Dashboard)
document.addEventListener("DOMContentLoaded", function() {
    // Check if we are on the student page and if feeStatus is defined
    if (typeof feeStatus !== 'undefined' && feeStatus === 'unpaid') {
        // Check session storage to see if user dismissed it this session
        if (!sessionStorage.getItem('feeBannerDismissed')) {
            const banner = document.getElementById('fee-alert');
            if(banner) banner.style.display = 'flex';
        }
    }
});

function dismissBanner() {
    document.getElementById('fee-alert').style.display = 'none';
    sessionStorage.setItem('feeBannerDismissed', 'true');
}

function downloadVoucher() {
    alert("Downloading Fee Voucher PDF...");
    // Logic to redirect to PHP PDF generator would go here
}