# First-Time Setup: Cloning the Repo into VS Code
### (Windows)

## 1. Install the Tools
- Watch this tutorial and follow the instructions to install php https://www.youtube.com/watch?v=n04w2SzGr_U
- Install nvm https://github.com/coreybutler/nvm-windows/releases/download/1.2.2/nvm-setup.exe
- Open command prompt and run ```nvm install lts``` then follow the on-screen instructions (don't forget to run ```nvm use 22.20.0``` or whatever number it says)
- Install composer https://getcomposer.org/Composer-Setup.exe
- Install VS Code https://code.visualstudio.com/download



## 2. Sign In to GitHub in VS Code

- Bottom-left corner, click **Accounts** → **Sign in with GitHub**
- A browser opens → log in → allow access
- Now VS Code is connected to GitHub



## 3. Clone the Project Repo

1. Copy the repo link: [https://github.com/akh5l/CS2-TP.git](https://github.com/akh5l/CS2-TP.git "‌")
2. In VS Code, open **Command Palette** (`Ctrl + Shift + P`)
   - Type **Git: Clone** → paste the repo link
   - Choose a folder on your computer (e.g., `Documents/CS-Project`)
3. VS Code asks: _“Open cloned repo?”_ → Click **Yes**



## 4. Install Dependencies and Configure Git
1. Go to VS Code settings and search ```powershell```
2. Open the dropdown and select ```Command Prompt```
3. Open a terminal in VS Code (**View → Terminal**)
4. In the terminal, run ```git config --global user.name YOUR_NAME``` making sure to replace YOUR_NAME with your github username
5. Run ```git config --global user.email YOUR_EMAIL``` making sure to replace YOUR_EMAIL with the email your GitHub account uses
6. In the same terminal, run ```php.ini``` and use ```Ctrl+F``` to find ```;extension=fileinfo``` and ```;extension=pdo_sqlite``` then delete the ```;``` before both of these
7. Run ```composer install```
8. Run ```npm install```



## 5. Set Up Project

1. In the same VS Code terminal, copy the example .env file:
   ```
   copy .env.example .env

   ```
2. Generate app key:
   ```
   php artisan key:generate

   ```
3. Copy the sample database file:
   ```
   copy database\database.sqlite.example database\database.sqlite

   ```
4. Generate database migrations:
   ```
   php artisan migrate

   ```


## 6. Run the Project

Two terminals needed (**View → Terminal then Ctrl+Shift+5**):

```
# Terminal 1 → run Laravel
php artisan serve

# Terminal 2 → run Tailwind/Vite
npm run dev
```

- Now visit [**http://localhost:8000**](http://localhost:8000 "‌") in your browser.
- You can see changes made to CSS/JS update the website in real time!
