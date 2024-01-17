const languageData = {};
const loadLanguageData = async (lang) => {
    try {
      const response = await fetch(`json/${lang}.json`);
      const data = await response.json();
      languageData[lang] = data;
    } catch (error) {
      console.error(error);
      // Hiển thị thông báo lỗi cho người dùng
    }
};
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
// Hàm thiết lập ngôn ngữ
function setLanguage(lang) {
    localStorage.setItem('selectedLang', lang);
    updateLanguageContent(lang);

    const dropdownButton = document.querySelector('.dropdown-toggle');
    dropdownButton.textContent = getLanguageText(lang);
}

// Update the UI content with the current language
const updateLanguageContent = () => {
    const loginData = languageData[currentLanguage]['login'];

    const titleEl = document.querySelector("h1");
    const subtitleEl = document.querySelector(".specific-subtitle");
    const registerLink = document.querySelector(".new-register");
    const emailInput = document.querySelector("input[name='email']");
    const passwordInput = document.querySelector("input[name='password']");
    const rememberPasswordLabel = document.querySelector("label[for='pass_save']");
    const loginBtn = document.querySelector("button[name='login']");

    const defaultLink = registerLink.getAttribute("data-lang-link");
    registerLink.textContent = loginData.registerText;
    registerLink.href = defaultLink;

    titleEl.textContent = loginData.title;
    subtitleEl.textContent = loginData.subtitle;
    emailInput.placeholder = loginData.emailPlaceholder;
    passwordInput.placeholder = loginData.passwordPlaceholder;
    rememberPasswordLabel.textContent = loginData.rememberPasswordLabel;
    loginBtn.textContent = loginData.loginButton;


};


// Attach event listener to dropdown menu items
const dropdownItems = document.querySelectorAll(".change-lang");
dropdownItems.forEach((item) => item.addEventListener("click", async (event) => {
    currentLanguage = event.target.dataset.lang;
    if (!languageData[currentLanguage]) {
        console.log(currentLanguage)
        await loadLanguageData(currentLanguage);
        setLanguage(currentLanguage);
        updateLanguageContent(); // Gọi hàm cập nhật nội dung sau khi dữ liệu đã được tải xong
    } else {
        updateLanguageContent();
    }
}));


  
  