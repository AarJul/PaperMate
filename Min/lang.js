
document.addEventListener("DOMContentLoaded", function() {
    const languageOptions = document.querySelectorAll('.change-lang');

    // Kiểm tra ngôn ngữ đã được chọn trước đó
    const selectedLang = localStorage.getItem('selectedLang');
    if (selectedLang) {
        setLanguage(selectedLang);
    }

    // Lắng nghe sự kiện click để thay đổi ngôn ngữ
    languageOptions.forEach(function(option) {
        option.addEventListener('click', function(event) {
            event.preventDefault();

            const lang = this.getAttribute('data-lang');
            setLanguage(lang);
        });
    });

    // Hàm để thiết lập ngôn ngữ và làm mới trang
    function setLanguage(lang) {
        // Lưu trữ ngôn ngữ được chọn vào localStorage
        localStorage.setItem('selectedLang', lang);

        // Đặt ngôn ngữ cho thanh chọn ngôn ngữ
        const dropdownButton = document.querySelector('.dropdown-toggle');
        dropdownButton.textContent = getLanguageText(lang);

        // Làm mới trang để áp dụng ngôn ngữ mới
        location.reload();
    }

    // Hàm để lấy văn bản ngôn ngữ dựa trên mã ngôn ngữ
    function getLanguageText(lang) {
        switch (lang) {
            case 'en':
                return 'English';
            case 'vn':
                return 'Tiếng Việt';
            case 'jp':
                return '日本語';
            case 'indo':
                return 'Indonesia';
            default:
                return 'Select Language';
        }
    }
});

