window.addEventListener('DOMContentLoaded', function(){

   var toggleDarkLight = document.querySelector(".fa-sun");

    var storedTheme = localStorage.getItem('theme') || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
    if (storedTheme)
        document.documentElement.setAttribute('data-theme', storedTheme)
    
    
    toggleDarkLight.onclick = function() {
        var currentTheme = document.documentElement.getAttribute("data-theme");
        var targetTheme = "light";
    
        if (currentTheme === "light") {
            targetTheme = "dark";
            toggleDarkLight.classList.add("dark");
            toggleDarkLight.classList.remove("light");

        }else{
            targetTheme = "light";
            toggleDarkLight.classList.add("light");
            toggleDarkLight.classList.remove("dark");

        }
    
        document.documentElement.setAttribute('data-theme', targetTheme)
        localStorage.setItem('theme', targetTheme);
    };
    
    
});