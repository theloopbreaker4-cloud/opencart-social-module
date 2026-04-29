# GCOMP Social Module

Social networks management module for OpenCart 3 (gcomp.ge).

## Features
- Social networks list: Messenger, Telegram, Viber, WhatsApp, Email, Phone, etc.
- Admin panel management: label (3 languages), icon, link, color, position
- Two positions: header (dropdown menu) and floating (floating button)
- Single data source — both widgets stay in sync

## Installation
1. Upload `site_upload/*` to the server into `/public_html/`
2. Run `deploy.sql` via phpMyAdmin
3. Grant permissions in **System → Users → User Groups → Administrator**:
   - Access permission: `extension/module/gcomp_social`
   - Modify permission: `extension/module/gcomp_social`
4. Enable the module: **Extensions → Modules → Social Networks → Install + Enable**
5. Assign the module to layouts (Design → Layouts)

## Structure
```
site_upload/
├── admin/controller/extension/module/gcomp_social.php
├── admin/model/extension/module/gcomp_social.php
├── admin/view/template/extension/module/gcomp_social.twig
├── admin/view/template/extension/module/gcomp_social_form.twig
├── admin/language/{ge-ka,en-gb,ru-ru}/extension/module/gcomp_social.php
├── catalog/controller/extension/module/gcomp_social.php
├── catalog/view/theme/chameleon/template/extension/module/gcomp_social.twig
└── catalog/view/javascript/gcomp_social/{social.css,social.js}
```
