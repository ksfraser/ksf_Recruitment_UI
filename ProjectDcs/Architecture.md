# Architecture - ksf_Recruitment_UI

## Document Information
- **Module**: ksf_Recruitment_UI
- **Version**: 1.0.0
- **Date**: 2026-05-11
- **Status**: Implemented
- **Author**: KSFII Development Team

---

## 1. Module Overview

ksf_Recruitment_UI provides the WordPress ESS user interface for Recruitment functionality.

### 1.1 Namespace
`Ksfraser\RecruitmentUI`

### 1.2 Adapter Pattern
```
ksf_Recruitment (Business Logic)
    ↓
ksf_Recruitment_UI (WordPress ESS Adapter)
    ↓
    WordPress ESS Portal
```

---

## 2. Component Architecture

### 2.1 Presenter Layer

| Presenter | Description |
|-----------|-------------|
| ListPresenter | List page logic |
| FormPresenter | Form handling |
| DetailPresenter | Detail view logic |

### 2.2 AJAX Handlers

| Endpoint | Action | Description |
|----------|--------|-------------|
| ksf_Recruitment_list | getList | Get items |
| ksf_Recruitment_save | saveItem | Save item |
| ksf_Recruitment_delete | deleteItem | Delete item |

---

## 3. Integration

### Consumed From
| Module | Interface |
|--------|-----------|
| ksf_Recruitment | Business logic |

### WordPress Integration
| Hook | Description |
|------|-------------|
| wp_ajax_ksf_Recruitment | AJAX handlers |
| ksf_Recruitment_template | Page templates |

---

*Document Version: 1.0.0*
*Last Updated: 2026-05-11*
