const languageData = {};
const loadLanguageData = async (lang) => {
    try {
      const response = await fetch(`../Min/json/${lang}.json`);
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
function autoSwitchLanguage() {
    const supportedLanguages = ['en', 'vi', 'jp', 'indo']; 
    const currentIndex = supportedLanguages.indexOf(currentLanguage);
    const nextLanguage = supportedLanguages[(currentIndex + 1) % supportedLanguages.length];
    setLanguage(nextLanguage);
}


// Update the UI content with the current language
const updateLanguageContent = () => {
    const regisData = languageData[currentLanguage]['register'];

    const title = document.querySelector("h2");
    const username = document.querySelector(".username");
    const email = document.querySelector(".email");
    const password = document.querySelector(".password"); 
    const rePassword = document.querySelector(".rePassword"); 
    const telephone = document.querySelector(".telephone");
    const preferredLanguage = document.querySelector(".PreferredLang"); 
    const usernamePlaceholder = document.querySelector(".username-input");
    const emailPlaceholder = document.querySelector(".email-input");
    const passwordPlaceholder = document.querySelector(".password-input");
    const rePasswordPlaceholder = document.querySelector(".rePassword-input");
    const telephonePlaceholder = document.querySelector(".telephone-input");
    const registerButton = document.querySelector("button[name='register']"); 


    title.textContent = regisData.RegisterNewAccount;
    username.textContent = regisData.Username;
    email.textContent = regisData.Email;
    password.textContent = regisData.Password;
    rePassword.textContent = regisData.ReenterPassword;
    telephone.textContent = regisData.Telephone;
    preferredLanguage.textContent = regisData.PreferredLanguage
    usernamePlaceholder.placeholder = regisData.UsernamePlaceholder;
    emailPlaceholder.placeholder = regisData.EmailPlaceholder;
    passwordPlaceholder.placeholder = regisData.PasswordPlaceholder;
    rePasswordPlaceholder.placeholder = regisData.ReenterPasswordPlaceholder;
    telephonePlaceholder.placeholder = regisData.TelePlaceholder;
    registerButton.textContent = regisData.REGISTER;

};


// Attach event listener to dropdown menu items
const dropdownItems = document.querySelectorAll(".change-lang");
// Attach event listener to dropdown menu items
dropdownItems.forEach((item) => item.addEventListener("click", async (event) => {
    currentLanguage = event.target.dataset.lang;
    if (!languageData[currentLanguage]) {
        await loadLanguageData(currentLanguage);
        setLanguage(currentLanguage);
        updateLanguageContent();
        autoSwitchLanguage();
    } else {
        updateLanguageContent();
        autoSwitchLanguage();
    }
}));



  
  