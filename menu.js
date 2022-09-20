
function Menu() {
    this.hamburger = document.querySelector("#hamburger")
    this.menu = document.querySelector(".navbar-mobile")
    this.menuIsOpen = false;
}
function open() {
    this.menu.style.display = "block";
    this.menuIsOpen = true;
}

function close() {
    this.menu.style.display = "none";
    this.menuIsOpen = false;
}


Menu.prototype.open = open;
Menu.prototype.close = close;
Menu.prototype.toggle = function() {
    this.menuIsOpen ? this.close() : this.open();
}


