# My CodeIgniter & Tailwind CSS Development Workflow

## 1. Start Your Backend (Database & Web Server)

- Open the **XAMPP Control Panel**.
- Start the **Apache** module.
- Start the **MySQL** module.
- (Keep the XAMPP Control Panel open or minimized, as these need to run continuously.)

## 2. Start Your Frontend Build Process (Tailwind CSS)

- Open **VS Code**.
- Open your **CodeIgniter project folder** (e.g., `C:\xampp\htdocs\LTWCE`).
- Open a **new VS Code Terminal** (Terminal > New Terminal or `Ctrl+``).
- In the terminal, run:

  `npm run dev   `

- This terminal will stay open and watch for changes in your CodeIgniter view files (`app/Views`) and JavaScript files (`public/assets/js`). It will automatically recompile `public/assets/css/tailwind_output.css` whenever you save a file.

## 3. Access Your Application

- Open your **web browser** (e.g., Chrome, Edge).
- Navigate to your CodeIgniter application's URL, which is served by Apache:

  `http://localhost/LTWCE/`

- (You don't need to run

`php spark serve`

- if you're using XAMPP's Apache to serve the app, but you still need to run

`npm run dev`

for Tailwind.)

- you can run all in separate terminals

`php spark serve`
`npm run dev`

## 4. Develop!

- Make changes to your **CodeIgniter view files** (e.g., `app/Views/welcome_message.php`).
- Add or modify **Tailwind CSS classes** in your HTML.
- Save your files.
- Observe the **npm run dev** terminal – it should show `Rebuilding... Done....`
- Manually refresh your browser (F5 or `Ctrl+R`) to see the updated styles. (Apache doesn't automatically reload CSS like frontend dev servers do.)

---

# For Building / Deploying Your Application

## 1. Stop Development Processes

- Go to the **VS Code Terminal** where `npm run dev` is running and press `Ctrl+C` to stop it.
- You can keep **XAMPP Apache/MySQL** running if you have other projects, or stop them if not needed.

## 2. Generate Optimized CSS

- Open a **VS Code Terminal** (if not already open and in your project root).
- Run the **production build command**:

  ```bash
  npm run build
  ```

- This will generate the smallest, most efficient `public/assets/css/tailwind_output.css` by purging unused CSS and minifying it.

## 3. Deploy

- Copy all your **CodeIgniter project files** (including the newly built `public/assets/css/tailwind_output.css` and its `public` directory content) to your production web server.
- Ensure your production server's **Apache (or Nginx)** is correctly configured to serve your CodeIgniter application and its `public` folder.
