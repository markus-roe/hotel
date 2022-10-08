
function Menu() {
    this.hamburger = document.querySelector(".hamburger")
    this.menu = document.querySelector("#menu-links")
    this.menuIsOpen = false;
}
function open() {
    this.menu.classList.remove("closed");
    this.hamburger.classList.add("closed");
    this.menuIsOpen = true;
}

function close() {
    this.menuIsOpen = false;
    this.hamburger.classList.remove("closed");
    this.menu.classList.add("closed");
}

function toggle() {
    this.menuIsOpen ? this.close() : this.open();

}

Menu.prototype.open = open;
Menu.prototype.close = close;
Menu.prototype.toggle = toggle;
const menu = new Menu();
document.querySelector(".hamburger").addEventListener("click", () => {menu.toggle()})

//TODO: wenn man neben das Menu klickt, sollte es sich schließen