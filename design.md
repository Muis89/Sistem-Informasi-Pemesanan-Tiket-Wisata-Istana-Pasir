# Sistem Informasi Pemesanan Tiket Wisata Istana Pasir Cilegon
## Front-End Blueprint & Progress Checklist

### 1. Color Palette & Typography Theme
* **Theme:** Beach / Sand / Amusement Park
* **Color Palette:**
  - **Sandy Gold (Primary/Accent):** Tailwind `amber-500` / `amber-600` (Warm sandy beach vibes, gold sand castles).
  - **Sky Blue (Secondary/Brand):** Tailwind `sky-500` / `sky-600` (Clear coastal sky, ocean water).
  - **Clean Neutrals (Background/Text):** Tailwind `slate-50` (Backgrounds), `slate-900` (Primary text), `slate-700` (Muted details), white (Cards & containers).
* **Typography:** `Instrument Sans` or `Inter`, clean, legible, modern.

---

### 2. UI Component Checklist & Progress Status

#### [x] Phase 1: Setup & CSS Configuration
- [x] Configure `@theme` in `resources/css/app.css` for custom sandy-gold and sky-blue variables.
- [x] Set up layouts and base template `resources/views/layouts/app.blade.php`.

#### [ ] Phase 2: Guest / Visitor Pages
- **[ ] Guest/Visitor Landing Page (`/`):**
  - [ ] Hero Section: Captivating header with beach/amusement park imagery, tagline, and call to action.
  - [ ] Ticket List Section: Beautiful responsive grid of cards showing ticket types, prices, available stock, and descriptions.
  - [ ] Action Button: "Pesan Sekarang" button redirecting users to the registration/login page.
  - [ ] Features/Facilities Section: Quick overview of what Istana Pasir Cilegon offers (Sand castles, playgrounds, swimming pools).
  - [ ] Footer: Contact information, address, and social links.

#### [ ] Phase 3: Authentication Pages
- **[ ] Login Page (`/login`):**
  - [ ] Styled centered card.
  - [ ] Input fields: Username/Email, Password.
  - [ ] Action buttons: "Masuk" and redirect link to Registration page.
- **[ ] Registration Page (`/register`):**
  - [ ] Responsive signup card.
  - [ ] Input fields: Full Name, Email, Phone Number, Password, Password Confirmation.
  - [ ] Action buttons: "Daftar" and redirect link back to Login page.

#### [ ] Phase 4: Visitor Dashboard & Booking
- **[ ] Visitor Dashboard (`/visitor/dashboard`):**
  - [ ] Welcome header displaying user info.
  - [ ] Active bookings overview table or cards.
- **[ ] Ticket Booking Form (`/visitor/book`):**
  - [ ] Input fields: Ticket type selector, quantity inputs.
  - [ ] Dynamic Total Price Counter: Real-time calculation using Vanilla JavaScript.
  - [ ] Form submit button directing to Checkout.
- **[ ] Checkout & Payment Simulation (`/visitor/checkout/{id}`):**
  - [ ] Review of order summary (Ticket type, quantity, total price).
  - [ ] Dummy bank transfer information (e.g., Bank Mandiri / BCA account number).
  - [ ] Manual confirmation upload: File input for "Bukti Pembayaran".
  - [ ] "Unggah & Konfirmasi" simulation action button.
- **[ ] E-Ticket View (`/visitor/ticket/{id}`):**
  - [ ] High-fidelity ticket voucher design.
  - [ ] Details: Booking ID, Visitor Name, Ticket Type, Quantity, Booking Date, Status Badge (Paid/Unpaid).
  - [ ] Placeholder QR Code (simulated with standard SVG layout or API).

#### [ ] Phase 5: Admin, Petugas Loket, & Owner Unified Dashboard
- **[ ] Unified Dashboard Layout:**
  - [ ] Responsive Left Sidebar with links to: Dashboard, Data Tiket, Data Pemesanan, Pembayaran, Laporan.
  - [ ] Modern Topbar showing user profile, role badge, and logout action.
  - [ ] Responsive toggle support for mobile screens.
- **[ ] Dashboard Overview (`/admin/dashboard`):**
  - [ ] Summary Statistics Cards (Total Visitors, Bookings, Payments, Revenue).
  - [ ] Quick activity or recent bookings overview table.
- **[ ] Data Tiket Section (`/admin/tickets`):**
  - [ ] Responsive tabular list of ticket types, prices, stock status.
  - [ ] Dummy CRUD action buttons ("Tambah Tiket", "Ubah", "Hapus") in interactive modal layouts.
- **[ ] Data Pemesanan Section (`/admin/bookings`):**
  - [ ] Booking transaction logs table showing visitor information, booking date, and status badges (Pending, Paid, Cancelled).
- **[ ] Pembayaran Section (`/admin/payments`):**
  - [ ] List of uploaded manual transfer verification requests.
  - [ ] "Kelola/Detail" interactive modal simulation containing:
    - [ ] Thumbnail of uploaded proof of payment.
    - [ ] "Setujui Pembayaran" / "Tolak Pembayaran" button actions.
- **[ ] Laporan Section (`/admin/reports`):**
  - [ ] Date/Month/Year filters UI.
  - [ ] Tabular report preview detailing daily/monthly tickets sold and revenue analysis.
  - [ ] Simulated "Cetak Laporan / Export PDF" action button.
