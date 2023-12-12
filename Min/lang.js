document.addEventListener("DOMContentLoaded", function() {
    const languageOptions = document.querySelectorAll('.change-lang');
    let languageJSON = {};

    // Hàm tải dữ liệu JSON dựa trên ngôn ngữ đã chọn
    function loadLanguageJSON(lang, callback) {
        const xhr = new XMLHttpRequest();
        xhr.overrideMimeType("application/json");
        xhr.open('GET', 'json/' + lang + '.json', true); // Sử dụng ngôn ngữ làm tên file JSON
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                callback(xhr.responseText);
            }
        };
        xhr.send(null);
    }

    // Chuyển đổi ngôn ngữ khi được chọn
    function setLanguage(lang) {
        localStorage.setItem('selectedLang', lang);
        loadLanguageJSON(lang, function(response) {
            languageJSON = JSON.parse(response);
            displayLanguageContent(lang);
            const dropdownButton = document.querySelector('.dropdown-toggle');
            dropdownButton.textContent = getLanguageText(lang);
        });
    }

    // Hiển thị nội dung ngôn ngữ
    function displayLanguageContent(lang) {
        const selectedData = languageJSON[lang];
        document.querySelector('h1').textContent = selectedData.title;
        document.querySelector('h4').textContent = selectedData.subtitle;
        document.querySelector('input[name="email"]').setAttribute('placeholder', selectedData.emailPlaceholder);
        document.querySelector('input[name="password"]').setAttribute('placeholder', selectedData.passwordPlaceholder);
        document.querySelector('label[for="pass_save"]').textContent = selectedData.rememberPasswordLabel;
        document.querySelector('button').textContent = selectedData.loginButton;
    }

    // Xử lý sự kiện chọn ngôn ngữ
    languageOptions.forEach(function(option) {
        option.addEventListener('click', function(event) {
            event.preventDefault();
            const lang = this.getAttribute('data-lang');
            setLanguage(lang);
        });
    });

    // Lấy văn bản ngôn ngữ
    function getLanguageText(lang) {
        switch (lang) {
            case 'en':
                return 'English';
            case 'vi':
                return 'Tiếng Việt';
            case 'jp':
                return '日本語';
            case 'indo':
                return 'Indonesia';
            default:
                return 'Select Language';
        }
    }

    // Kiểm tra ngôn ngữ đã được chọn trước đó
    const selectedLang = localStorage.getItem('selectedLang');
    if (selectedLang) {
        setLanguage(selectedLang);
    }
});
