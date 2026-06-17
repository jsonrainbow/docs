# Upgrade to HydePHP v2.0

## Summary

This repository is currently powered by HydePHP v1.8 (`hyde/framework: ^1.8`). HydePHP v2.0.0 was released on October 1, 2025 with significant improvements. We should upgrade to take advantage of the new features and continued support.

## Current State

- `hyde/framework`: `^1.8`
- `laravel-zero/framework`: `^10.0`
- PHP requirement: `^8.1`
- Frontend tooling: Laravel Mix with Tailwind CSS v3
- Build command: `npm run prod`

## Key Changes in Hyde 2.0

### Breaking Changes Relevant to This Repo

1. **PHP 8.2+ required** (currently requires `^8.1`)
2. **Laravel Mix → Vite**: `webpack.mix.js` must be replaced with a Vite config. Build command changes from `npm run prod` to `npm run build`.
3. **Tailwind CSS v3 → v4**: Run `npx @tailwindcss/upgrade` to migrate. `tailwind.config.js` format changes.
4. **ESM modules**: Frontend tooling uses ESM instead of CommonJS (our `webpack.mix.js` uses `require()` syntax).
5. **Navigation configuration format**: Array-based format for custom navigation items.
6. **Features configuration**: Static method calls replaced with enum values (already using `Feature` enum — verify compatibility).
7. **Asset API updates**: Method renames (`Hyde::mediaLink()` → `Hyde::asset()`, etc.).
8. **Sidebar configuration**: `docs.sidebar_order` → `docs.sidebar.order`, `docs.table_of_contents` → `docs.sidebar.table_of_contents`.
9. **`npm run prod` removed**: Replaced by `npm run build`.
10. **Prettier dependency removed**: We have `prettier` in `devDependencies` — can be removed if only used via Hyde.

### New Features We Can Leverage

- Vite with HMR for faster local development
- 40x faster table of contents generation (Blade-based)
- Alpine.js-powered documentation search
- CRC32 cache busting for better performance
- PHP 8.4 support and Laravel 11 compatibility
- Blade-based table of contents
- Dynamic source file links in Markdown

## Upgrade Steps

Based on the [official upgrade guide](https://hydephp.com/docs/2.x/upgrade-guide):

- [ ] Update PHP requirement to `^8.2` in `composer.json`
- [ ] Update `hyde/framework` to `^2.0` in `composer.json`
- [ ] Update `laravel-zero/framework` to `^11.0` in `composer.json`
- [ ] Run `composer update`
- [ ] Replace `webpack.mix.js` with Vite configuration
- [ ] Update `package.json`: remove `laravel-mix`, add Vite and related dependencies
- [ ] Run `npx @tailwindcss/upgrade` for Tailwind CSS v3 → v4 migration
- [ ] Remove `tailwind.config.js` (Tailwind v4 uses CSS-based config)
- [ ] Update npm scripts (`prod` → `build`, remove `dev`/`watch` Mix commands)
- [ ] Convert any CommonJS (`require()`) to ESM (`import`) syntax
- [ ] Review `config/hyde.php` for deprecated configuration keys
- [ ] Review `config/docs.php` for sidebar config key changes
- [ ] Verify navigation configuration format compatibility
- [ ] Update any Blade templates using removed components (e.g., search components)
- [ ] Remove `autoprefixer` from devDependencies (handled by Tailwind v4)
- [ ] Test site builds correctly with `npm run build` and `php hyde build`
- [ ] Update CI/CD workflows if they reference old build commands
- [ ] Update `hyde/realtime-compiler` to latest compatible version

## References

- [HydePHP v2.0.0 Release Notes](https://github.com/hydephp/hyde/releases/tag/v2.0.0)
- [Upgrade Guide](https://hydephp.com/docs/2.x/upgrade-guide)
- [Tailwind CSS v4 Upgrade Guide](https://tailwindcss.com/docs/upgrade-guide)
- [HydePHP v2.x Documentation](https://hydephp.com/docs/2.x)
