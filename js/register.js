const sr = ScrollReveal({
    distance: '65px',
    duration: 2600,
    delay: 450,
    reset: true
  });
  
  sr.reveal('.form-box', { delay: 250, origin: 'left' });
  sr.reveal('h2', { delay: 300, origin: 'top' });
  sr.reveal('.form-value', { delay: 350, origin: 'top' });
  
  var inputbox = document.getElementById("pw");
  var capital = document.getElementById("capital");
  var scharacter = document.getElementById("scharacter");
  var number = document.getElementById("number");
  var length = document.getElementById("length");
  var space = document.getElementById("space");
  var validationDiv = document.getElementById("validation");
  
  inputbox.onfocus = function () {
    validationDiv.style.display = "block";
  };
  
  inputbox.onblur = function () {
    validationDiv.style.display = "none";
  };
  
  inputbox.onkeyup = function () {
    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (inputbox.value.match(upperCaseLetters)) {
      capital.classList.remove("invalid");
      capital.classList.add("valid");
    } else {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
    }
  
    // Validate special characters
    var specialCharacters = /[^a-zA-Z0-9\s]/g;
    if (inputbox.value.match(specialCharacters)) {
      scharacter.classList.remove("invalid");
      scharacter.classList.add("valid");
    } else {
      scharacter.classList.remove("valid");
      scharacter.classList.add("invalid");
    }
  
    // Validate numbers
    var numbers = /[0-9]/g;
    if (inputbox.value.match(numbers)) {
      number.classList.remove("invalid");
      number.classList.add("valid");
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
    }
  
    // Validate length
    if (inputbox.value.length >= 6) {
      length.classList.remove("invalid");
      length.classList.add("valid");
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
    }
  
    // Validate space
    var spaces = /[*\s]/g;
    if (inputbox.value.match(spaces)) {
      space.classList.remove("valid");
      space.classList.add("invalid");
    } else {
      space.classList.remove("invalid");
      space.classList.add("valid");
    }
  
    // Check if all validation criteria are met
    if (
      capital.classList.contains("valid") &&
      scharacter.classList.contains("valid") &&
      number.classList.contains("valid") &&
      length.classList.contains("valid") &&
      !space.classList.contains("invalid")
    ) {
      validationDiv.style.display = "none";
    } else {
      validationDiv.style.display = "block";
    }
  };
  