# 🛡️ ระบบ RBAC (Role-Based Access Control) ด้วย Laravel + SQL Server

ระบบจัดการสิทธิ์การเข้าถึง (RBAC) สำหรับเว็บแอปพลิเคชัน Laravel โดยสามารถกำหนดสิทธิ์การใช้งานแต่ละโปรแกรม (Module) ตามบทบาท (Role) และผู้ใช้งาน (User) ได้อย่างละเอียด

## ✅ ฟีเจอร์หลัก

- กำหนดบทบาทผู้ใช้งาน (Role)
- สร้างโปรแกรมหรือโมดูลที่ต้องควบคุมการเข้าถึง (Program)
- กำหนดสิทธิ์แต่ละฟังก์ชันในโปรแกรม (Permission)
- ตรวจสอบสิทธิ์ผ่าน Middleware
- เชื่อมโยง Role, Program, Permission, และ User
- รองรับฐานข้อมูล SQL Server , Mysql
- มี UI จัดการสิทธิ์ด้วย Blade + Tailwind CSS

---

## 📦 โครงสร้างตาราง (5+1 ตาราง)

| ชื่อตาราง | คำอธิบาย |
|-----------|----------|
| `users` | เก็บข้อมูลผู้ใช้งาน |
| `Permission_roles` | เก็บข้อมูลบทบาท |
| `Permission_programs` | เก็บโปรแกรมหรือโมดูลต่าง ๆ |
| `Permission_permissions` | เก็บสิทธิ์การใช้งาน เช่น View, Edit, Delete |
| `Permission_role_program_permission` | เชื่อมโยง user, role, program, permission |
| *(+ standard Laravel tables)* | เช่น `migrations`, `password_resets`, `personal_access_tokens` |

---


## ⚙️ การติดตั้ง

### 1. Clone โปรเจกต์

```bash
git clone https://github.com/chokzass2007/NCmanagement.git.git
cd laravel-rbac
```

```bash
## ติดตั้ง Dependencies
composer install
npm install && npm run build
```

 ตั้งค่า .env
cp .env.example .env

แล้วแก้ไขค่าต่อไปนี้ให้เชื่อมต่อกับ SQL Server:
DB_CONNECTION=sqlsrv
DB_HOST=127.0.0.1
DB_PORT=1433
DB_DATABASE=ชื่อฐานข้อมูล
DB_USERNAME=ชื่อผู้ใช้
DB_PASSWORD=รหัสผ่าน

Generate Key
```bash
php artisan key:generate
```
 และ Migration
```bash
php artisan migrate --seed
```

🔐 วิธีใช้งานระบบสิทธิ์
1. ตรวจสอบสิทธิ์ใน Controller

if (auth()->user()->hasPermission('View', $program)) {
    // เข้าถึงได้
}

2. ใช้ Middleware
Route::middleware(['auth', 'check.permission:View,Management'])->group(function () {
    Route::get('/management', [ManagementController::class, 'index']);
});

🧪 ตัวอย่างผู้ใช้งาน (Seeder)
```bash
Email: admin@system.com
Password: 123456
```
📄 License
แจกฟรี 100% สามารถนำไปใช้และปรับปรุงได้ตามต้องการ  
สร้างโดย [Numchok.j](https://www.facebook.com/CJdc2011)

