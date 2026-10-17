# Academic portfolio theme for WordPress

The block theme behind [amahmood.com](https://amahmood.com), built for a doctoral-application portfolio.

## Features

- **Full site editing** block theme (WordPress 6.4+, PHP 7.4+), no page builder and no tracking.
- **Live research-network hero**: a canvas of drifting nodes, signal pulses and faint mathematical notation,
  paused when off screen and still for users who prefer reduced motion.
- **Hanging name**: each letter is a damped pendulum that swings with the pointer and on scroll.
- **Counting meters**: research numbers count up from zero on load, with animated progress bars.
- **Settings screen** (Settings, Site content): contact details, CV file, portrait, certificates, gallery and
  section copy are editable without touching code. Shortcodes expose every value.
- **CV viewer**: the PDF opens in an accessible modal with a focus trap, loaded only on first open.
- **Achievements and gallery**: equal-size tiles with hover preview and a full-screen lightbox.
- Accessible by default: skip link, keyboard focus states, ARIA labels, reduced-motion support.

## Stack

PHP (WordPress theme API, Settings API, shortcodes) · `theme.json` · vanilla JavaScript (Canvas 2D,
IntersectionObserver, ResizeObserver, requestAnimationFrame) · CSS (grid, custom properties, backdrop filters).

## Structure

```
functions.php            settings screen, shortcodes, CV modal
theme.json               palette, type scale, layout
assets/css/theme.css     all styling
assets/js/site.js        hanging name, meters, zoom, hero network
patterns/                front-page sections and the CV page
templates/, parts/       block templates, menu and footer
```

## Licence

GPL-2.0-or-later, as required for WordPress themes.
