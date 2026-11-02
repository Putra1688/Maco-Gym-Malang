# Product Requirement Document (PRD)
## Makro Gym Malang Management System

### 1. Document Overview
* **Project Name:** Makro Gym Malang Web System
* **Version:** 1.0.0
* **Date:** October 26, 2026
* **Target Stack:** PHP (Laravel), Google Sheets API (Initial DB) transitionable to MySQL (via phpMyAdmin), Responsive Web (SEO Optimized)

---

### 2. Product Objectives & Scope
The objective is to create a lightweight, responsive, and SEO-optimized web application for Makro Gym Malang to manage public landing pages, user registrations, membership tracking, and basic admin metrics.

---

### 3. User Roles & Key Features

#### 3.1. Guest Mode (Public Landing Page)
* **Hero Section:** Branding, CTA for registration.
* **Facilities Section:** Showcase of gym equipment and amenities.
* **Product Catalog:** List of membership plans and single/group sessions.
* **Personal Trainer Directory:** Bios, specialties, and schedules of available trainers.
* **FAQ Section:** Frequently asked questions for quick user resolution.
* **Registration Form:** Guest signup form capturing basic details. Submissions trigger a status update sent to the Admin queue for verification.

#### 3.2. Admin Role
* **Dashboard:**
  * Summary Cards: Total Members, Active Members, Pending Verification Registrations, Near-Expiration Members.
  * Revenue Analytics: Bar chart tracking revenue from verified memberships.
  * Member Demographics: Pie chart showing gender breakdown and age distribution.
* **Member Data Management:** Table view showing active status, expiration dates, and verification triggers.
* **Product & Trainer Management (CMS):** Interface to create, update, or disable membership plans, packages, and trainer profiles.

#### 3.3. Member Role
* **Member Dashboard:** Real-time display of current membership status and remaining active days.
* **Physical Profile:** Personal tracking tool for members to log and view changes in weight and height over time.

---

### 4. Technical Architecture & Database Design

#### 4.1. Tech Stack
* **Frontend/Backend Framework:** Laravel (PHP) for server-side rendering, SEO performance, and modular role expansion.
* **Initial Database Layer:** Google Sheets API integration.
* **Target Database Layer:** MySQL managed via phpMyAdmin (for future scalability).

#### 4.2. Initial Data Schema (Spreadsheet Structure)

1. **`Members` Sheet**
   | Column Name | Type | Description |
   |---|---|---|
   | `ID` | String/INT | Unique Identifier |
   | `Name` | String | Full Name |
   | `Email` | String | Contact Email |
   | `Phone` | String | Contact Number |
   | `Status` | Enum | `Active`, `Pending`, `Inactive` |
   | `Start_Date` | Date | Membership Start Date |
   | `End_Date` | Date | Membership Expiration Date |

2. **`Products` Sheet**
   | Column Name | Type | Description |
   |---|---|---|
   | `Product_ID` | String/INT | Unique Product Identifier |
   | `Product_Name` | String | Package/Service Title |
   | `Price` | Numeric | Cost in IDR |
   | `Duration_Days` | INT | Active Duration |

3. **`Attendance` Sheet**
   | Column Name | Type | Description |
   |---|---|---|
   | `Checkin_ID` | String/INT | Entry Log ID |
   | `Member_ID` | String/INT | Foreign Key from Members |
   | `Date` | Date | Check-in Date |
   | `Time` | Time | Check-in Time |

4. **`Trainers` Sheet**
   | Column Name | Type | Description |
   |---|---|---|
   | `Trainer_ID` | String/INT | Unique Trainer Identifier |
   | `Name` | String | Trainer Name |
   | `Specialty` | String | Focus Area/Skill |

---

### 5. Future Enhancements
* Migration from Google Sheets to MySQL database.
* Granular access control for expanded admin and member sub-roles.
* Automated WhatsApp/Email notifications for membership renewal.