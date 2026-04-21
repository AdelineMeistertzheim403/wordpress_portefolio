# Adeline Portfolio Theme

Custom starter theme for this project.

## Files

- style.css: Theme metadata
- functions.php: Theme setup and assets enqueue
- header.php / footer.php: Main layout wrappers
- front-page.php: Homepage template
- archive-project.php / single-project.php: Project portfolio templates
- page-contact.php: Dedicated contact page template
- page-realisations.php: Dedicated case-study realizations template
- page.php, single.php, index.php: Core templates
- assets/css/main.css: Main styles
- assets/js/main.js: Small reveal animation

## Homepage

- The homepage combines editable page content with optional theme-driven sections.
- Toggle homepage sections from Appearance > Customize > Accueil Portfolio.
- If the front page content is empty, the theme still shows editorial sections and portfolio blocks.
- Home builder mode is configurable: Theme only, Elementor only, or Hybrid.
- In Hybrid mode, you can keep Elementor content and selectively retain theme sections (including hero).

## Visibility Controls

- Per page/post/project controls are available in the editor sidebar under Affichage de la page.
- You can hide/show hero, main content, featured image, contextual blocks, form/sidebar, case study details, and navigation depending on template usage.
- You can also choose a preset in the same box:
	- Pages: CV focalise, Contact minimal, Realisations showcase
	- Posts: Article long-form
	- Projects: Projet etude de cas
- Select a preset and update the page to apply all related visibility settings automatically.
- Global list page visibility toggles are in Appearance > Customize > Visibilite des pages liste:
	- Articles hero and pagination
	- Projects archive hero and pagination

## Projects

- A custom post type named Projets is registered by the theme.
- Add projects from the WordPress admin to feed the homepage grid and the /projets archive.
- Each project supports title, content, excerpt and featured image.
- For case studies, optional custom fields can be added on projects:
	- project_context
	- project_role
	- project_stack
	- project_result
	- project_duration

## Next steps

1. Activate the theme in WordPress admin.
2. Assign a menu to the Primary Menu location.
3. Add a few Project entries in the admin.
4. Review homepage section toggles in the Customizer.
5. Add custom template parts as your site grows.
