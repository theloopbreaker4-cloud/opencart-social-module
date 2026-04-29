# GCOMP Social Module

Модуль управления соцсетями для OpenCart 3 (gcomp.ge).

## Возможности
- Список соцсетей: Messenger, Telegram, Viber, WhatsApp, Email, Phone и др.
- Управление из админки: название (3 языка), иконка, ссылка, цвет, позиция
- Две позиции: header (выпадающее меню) и floating (плавающая кнопка)
- Один источник данных — оба виджета синхронны

## Установка
1. Загрузить `site_upload/*` на сервер в `/public_html/`
2. Выполнить `deploy.sql` через phpMyAdmin
3. Дать права в **System → Users → User Groups → Administrator**:
   - Access permission: `extension/module/gcomp_social`
   - Modify permission: `extension/module/gcomp_social`
4. Включить модуль: **Extensions → Modules → Social Networks → Install + Enable**
5. Прописать модуль в layouts (Design → Layouts)

## Структура
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
