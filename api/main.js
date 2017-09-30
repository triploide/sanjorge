const electron = require('electron');
const {app, BrowserWindow, Menu} = electron;

function createMainMenu () {
    let template; //json
    Menu.setApplicationMenu(Menu.buildFromTemplete(template));
}

app.on('ready', () => {
    let win = new BrowserWindow({width: 800, height: 600});
    win.loadURL(`file://${__dirname}/index.html`);
    win.webContents.openDevTools();
});

app.on('window-all-closed', () => {
    app.quit()
})