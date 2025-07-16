const { app, BrowserWindow } = require("electron");
const { exec } = require("child_process");
const path = require("path");
const net = require("net");

let phpServerProcess;
let port = 8001;

// Check if port is free
function checkPortAvailable(port, callback) {
  const server = net.createServer();
  server.once('error', () => callback(false));
  server.once('listening', () => {
    server.close();
    callback(true);
  });
  server.listen(port);
}

function findAvailablePort(startingPort, callback) {
  checkPortAvailable(startingPort, (isAvailable) => {
    if (isAvailable) {
      callback(startingPort);
    } else {
      findAvailablePort(startingPort + 1, callback);
    }
  });
}

function createWindow() {
  const win = new BrowserWindow({
    width: 1200,
    height: 800,
    autoHideMenuBar: true,
    webPreferences: {
      nodeIntegration: false,
    },
  });

  // Load Laravel app
  win.loadURL(`http://localhost:${port}`);

  win.maximize();
}

function startLaravelServer(callback) {
  const laravelPath = __dirname;

  // Use PHP built-in server (better than artisan serve)
  phpServerProcess = exec(
    `php -S localhost:${port} -t public`,
    {
      cwd: laravelPath,
      windowsHide: true, // 👈 Hide CMD window
    }
  );

  phpServerProcess.stdout.on("data", (data) => {
    console.log(`Laravel: ${data}`);
  });

  phpServerProcess.stderr.on("data", (data) => {
    console.error(`Laravel Error: ${data}`);
  });

  // Wait a second before launching window (give server time to boot)
  setTimeout(callback, 1000);
}

app.whenReady().then(() => {
  findAvailablePort(port, (availablePort) => {
    port = availablePort;
    startLaravelServer(() => {
      createWindow();
    });
  });
});

app.on("window-all-closed", () => {
  if (phpServerProcess) {
    phpServerProcess.kill();
  }
  if (process.platform !== "darwin") app.quit();
});
