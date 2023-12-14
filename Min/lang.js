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
  
  const defaultLanguage = "en"; // Set your default language here
  let currentLanguage = defaultLanguage;
  loadLanguageData(defaultLanguage) // Load default language data
  
  // Change language when clicking on dropdown menu items
  const changeLanguage = (event) => {
    currentLanguage = event.target.dataset.lang;
    updateLanguageContent();
    
  };
  
  // Update the UI content with the current language
  const updateLanguageContent = async () => {
    await loadLanguageData(currentLanguage); // Load current language data if not already loaded
  
    const languageDataObj = languageData[currentLanguage];
    const titleEl = document.querySelector("h1");
    const subtitleEl = document.querySelector("h4");
    const emailInput = document.querySelector("input[name='email']");
    const passwordInput = document.querySelector("input[name='password']");
    const rememberPasswordLabel = document.querySelector("label[for='pass_save']");
    const loginBtn = document.querySelector("button[name='login']");
  
    titleEl.textContent = languageDataObj.title;
    subtitleEl.textContent = languageDataObj.subtitle;
    emailInput.placeholder = languageDataObj.emailPlaceholder;
    passwordInput.placeholder = languageDataObj.passwordPlaceholder;
    rememberPasswordLabel.textContent = languageDataObj.rememberPasswordLabel;
    loginBtn.textContent = languageDataObj.loginButton;
  };
  
  // Attach event listener to dropdown menu items
  const dropdownItems = document.querySelectorAll(".change-lang");
  dropdownItems.forEach((item) => item.addEventListener("click", async (event) => {
    currentLanguage = event.target.dataset.lang;
    await loadLanguageData(currentLanguage);
    updateLanguageContent();
  }));
  