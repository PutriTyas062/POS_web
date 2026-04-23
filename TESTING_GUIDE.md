# Quick Test Guide - Reports & Settings Features

## Login Credentials
```
Admin User:
  Username: admin
  Password: admin123

Kasir User:
  Username: kasir
  Password: kasir123
```

---

## Testing Reports (Laporan) Dashboard

### 1. Access Reports Page
```
Step 1: Login as admin user
Step 2: Click navigation menu "Laporan" (Reports)
Step 3: Should see 3 tabs: Pendapatan | Pengeluaran | Perbandingan
```

### 2. Verify Initial Data Load
```
Verify Tab 1 - Pendapatan (Income):
  ✓ "Total Transaksi" stat card shows a number
  ✓ "Total Pendapatan" shows formatted currency (Rp)
  ✓ "Rata-rata Transaksi" shows average calculation
  ✓ "Terbesar Hari Ini" shows max transaction amount
  ✓ "Pendapatan Harian" line chart renders (orange line)
  ✓ "Metode Pembayaran" doughnut chart renders (3 colored circles)
  ✓ "Kategori Produk" pie chart renders
```

### 3. Test Date Range Filter
```
Step 1: Modify "Dari" (From) date to: 2024-01-01
Step 2: Modify "Sampai" (To) date to: 2024-01-31
Step 3: Click "Filter" button
Step 4: Verify all numbers update
Step 5: Verify all 5 charts re-render with new data
```

### 4. Test Tab Switching
```
Click "Pengeluaran" tab:
  ✓ Tab highlight moves to orange
  ✓ Income cards replaced with Expense cards
  ✓ See "Total Pengeluaran" stat card
  ✓ See "Kategori Terbanyak" stat card
  ✓ See "Rata-rata Harian" and "Pengeluaran Terbesar" stat cards
  ✓ See 2 charts: Daily expenses line chart + Category pie chart
```

### 5. Test Comparison Tab
```
Click "Perbandingan" tab:
  ✓ Shows comparison metrics
  ✓ "Total Pendapatan" stat card (same as income)
  ✓ "Total Pengeluaran" stat card (same as expense)
  ✓ "Laba Kotor" (Gross Profit) stat card
  ✓ "Margin Keuntungan" (Profit Margin) %, stat card
  ✓ Bar chart showing daily income vs expenses side-by-side
```

### 6. Test Print Function
```
Step 1: Click "Print" button
Step 2: Print dialog opens
Step 3: Print report to PDF or paper
Step 4: Close dialog
```

---

## Testing Settings (Pengaturan) Page

### 1. Access Settings Page
```
Step 1: Login as admin user
Step 2: Click navigation menu "Pengaturan" (Settings)
Step 3: Should see 4 tabs: Profil Toko | Stok & Pajak | Pengguna | Data
```

### 2. Tab 1: Profil Toko (Store Profile)
```
Verify form fields visible:
  ✓ "Nama Toko" (Store Name) text input
  ✓ "Email Toko" (Store Email) text input
  ✓ "Alamat Tokoh" (Store Address) text area
  ✓ "No. Telp" (Phone) text input
  ✓ "NPWP" (Tax ID) text input
  ✓ Logo upload area with drag-drop
  ✓ "Simpan Pengaturan" (Save) button at bottom
  ✓ "Reset" button at bottom

Fill in data:
  Step 1: Enter "Toko Saya" in Nama Toko
  Step 2: Enter "toko@email.com" in Email Toko
  Step 3: Enter "Jln Merdeka 123" in Alamat
  Step 4: Enter "08123456789" in No. Telp
  Step 5: Enter "123456789012345" in NPWP
  Step 6: Click "Simpan Pengaturan"
  Step 7: See success alert: "✓ Pengaturan berhasil disimpan!"
```

### 3. Tab 2: Stok & Pajak (Stock & Tax Settings)
```
Verify form fields visible:
  ✓ PPN toggle switch
  ✓ "PPN %" text input (default: 11)
  ✓ "Limit Diskon" (Discount limit) text input
  ✓ "Stok Minimum" (Min Stock) text input
  ✓ "Format Nomor Transaksi" dropdown
  ✓ "Printer" name text input
  ✓ Auto-print toggle switch
  ✓ "Simpan Pengaturan" button at bottom

Test PPN Toggle:
  Step 1: Click PPN toggle - should show as enabled (blue)
  Step 2: Click again - should show as disabled (gray)
  Step 3: Change PPN % value to 15
  Step 4: Click "Simpan Pengaturan"
```

### 4. Tab 3: Pengguna (User Management)
```
Verify tab shows:
  ✓ "Kelola User" link button - links to /users
  ✓ "Tambah User Baru" link button - links to /users/create
  ✓ Instructions about user management
```

### 5. Tab 4: Data (Database Operations)
```
Verify 3 action cards:
  ✓ "Backup Database" button (blue) with icon
  ✓ "Restore Database" button (orange) with icon
  ✓ "Hapus Semua Data" button (red) with icon

Test Backup:
  Step 1: Click "Backup Database" button
  Step 2: Confirm dialog appears
  Step 3: Click OK
  Step 4: See success alert with filename
  Step 5: Check writable/backups/ folder for .sql file

Test Clear Data:
  Step 1: Click "Hapus Semua Data" button
  Step 2: Modal asks for confirmation
  Step 3: Type "YES" in confirmation input
  Step 4: Click confirm
  Step 5: Browser refreshes
  Step 6: Verify transaction records are deleted
```

### 6. Test Logo Upload
```
Step 1: Stay on Profil Toko tab
Step 2: Drag & drop logo image onto upload area
   - OR -
   - Click upload area to select file
Step 3: File should be selected (alert shows filename)
Step 4: Click "Simpan Pengaturan"
Step 5: Logo file uploaded to public/uploads/logo/
```

---

## Bug Testing Checklist

### Reports Page Issues
- [ ] Empty date range causes error?
- [ ] Very old date range returns no data?
- [ ] Charts overlap or display incorrectly?
- [ ] Stat cards show correct calculations?
- [ ] Filter doesn't work?
- [ ] Print button opens dialog?

### Settings Page Issues
- [ ] Form saves to JSON file?
- [ ] Refresh page maintains saved data?
- [ ] File upload creates file?
- [ ] Backup file contains valid SQL?
- [ ] Clear data actually deletes records?
- [ ] Confirmation modal appears for delete?

### Authorization Issues
- [ ] Can non-admin users access /reports?
- [ ] Can non-admin users access /settings?
- [ ] Can kasir user see reports menu item?
- [ ] Can kasir user see settings menu item?

---

## Expected Database State

### Before Testing Reports
```
Database should contain:
- At least 5+ transactions (for charts)
- Payment methods variation (Tunai, QRIS, Debit)
- Product categories: Makanan, Minuman, Lainnya
- At least 3-5 expenses with different categories
```

### Demo Data Available
```
Login as admin and run /kasir page:
- Already has 8 sample products
- Can create test transactions
- Can create test expenses

Or run seeder to populate sample data
```

---

## Browser Console Testing

### Open Developer Tools (F12)
```
Network Tab:
- Watch for request to /reports/data
- Check response is valid JSON
- Verify no 404 or 500 errors

Console Tab:
- Look for JavaScript errors
- Check for console.log outputs
- Verify no undefined references

Application Tab:
- Check SessionStorage/LocalStorage
- Verify Session ID stored
```

---

## Performance Testing

### Reports Dashboard Load Time
```
Expected: < 1 second for data fetch
- Open DevTools Network tab
- Filter to XHR requests
- Check /reports/data request duration
```

### Chart Rendering
```
Expected: Charts render within 500ms
- With small dataset: Should be instant
- With 30+ days data: Should still be fast
- Test with large date ranges
```

---

## Troubleshooting Common Issues

### Issue: Charts Not Rendering
```
Solution:
1. Check browser console for errors
2. Verify /reports/data returns valid JSON
3. Check Chart.js CDN is loading
4. Inspect API response in Network tab
```

### Issue: Settings Not Saving
```
Solution:
1. Verify user is admin role
2. Check writable/ folder permissions
3. Look for POST errors in Network tab
4. Check database connection working
```

### Issue: Backup File Not Created
```
Solution:
1. Check writable/backups/ folder exists
2. Verify file permissions (755)
3. Check disk space available
4. Look for SQL syntax errors in file
```

### Issue: Clear Data Confirmation Not Working
```
Solution:
1. Verify prompt accepts "YES" exact match
2. Check JavaScript not throwing errors
3. Test with exact string "YES" (case-sensitive)
4. Verify api endpoint /settings/clear exists
```

---

## Success Criteria

### Reports Feature: ✅ SUCCESS if:
- [x] All 3 tabs load without errors
- [x] All stat cards show formatted numbers
- [x] All 5 charts render with data
- [x] Date filter updates all content
- [x] Print function works
- [x] No JavaScript errors in console

### Settings Feature: ✅ SUCCESS if:
- [x] All 4 tabs visible and clickable
- [x] Forms can be filled with data
- [x] Data saves to JSON file
- [x] Data persists after page refresh
- [x] File upload works
- [x] Backup creates SQL file
- [x] Clear data works with confirmation
- [x] No JavaScript errors in console

---

## Next Steps After Testing

If all tests pass:
1. ✅ Create production deployment plan
2. ✅ Set up automated backups
3. ✅ Configure email alerts
4. ✅ Set up monitoring/logging
5. ✅ User training documentation

If tests fail:
1. Note the specific error
2. Check browser console for details
3. Review Network tab in DevTools
4. Check server logs in writable/logs/
5. Report issue with exact error message
