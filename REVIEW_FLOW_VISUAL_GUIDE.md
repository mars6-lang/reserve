# Review System - Visual Flow Guide

## 🔄 Complete Reservation & Review Flow

```
STEP 1: MAKE RESERVATION
┌─────────────────────────────────┐
│ Product Page                    │
│ [Qty: 5]  [Total: ₱750]       │
│           [RESERVE]            │
└─────────────────────────────────┘
           ↓
    Order Created
    Status: ACTIVE 🟡
           ↓
    ❌ Review Form NOT Shown
    Message: "Leave review when RECEIVED"
           ↓
┌─────────────────────────────────┐
│ Product Page (ACTIVE Order)     │
│                                 │
│ 📦 You can leave a review while │
│ the product is in RECEIVED      │
│ status.                         │
│                                 │
│ (No review form)                │
└─────────────────────────────────┘

─────────────────────────────────────

STEP 2: MARK AS RECEIVED
┌─────────────────────────────────┐
│ Tracking Page                   │
│ Order: Tomato (ACTIVE 🟡)       │
│ [✓ Mark as Received] [✗ Cancel]│
└─────────────────────────────────┘
           ↓
      User Clicks Button
      Confirmation Popup
           ↓
    Order Updated
    Status: RECEIVED 🔵
           ↓
    ✅ Review Form NOW Shown
           ↓
┌─────────────────────────────────┐
│ Product Page (RECEIVED Order)   │
│                                 │
│ Leave a Review                  │
│                                 │
│ Rating: [5 Stars dropdown]      │
│ Comment: [Text area]            │
│ Photo: [Upload button]          │
│                                 │
│         [Submit Review]         │
└─────────────────────────────────┘

─────────────────────────────────────

STEP 3: SUBMIT REVIEW
┌─────────────────────────────────┐
│ User fills form:                │
│ - Selects 5 stars              │
│ - Writes: "Fresh & crispy!"     │
│ - Clicks Submit                 │
└─────────────────────────────────┘
           ↓
      Review Created
      Seller Notified
           ↓
    ✅ "Review posted successfully!"
           ↓
      Page reloads
      Status still: RECEIVED 🔵
           ↓
    ❌ Review Form NOW HIDDEN
    Message: Already Reviewed
           ↓
┌─────────────────────────────────┐
│ Product Page (After Review)     │
│                                 │
│ ✅ Thank you! You have already  │
│ reviewed this product. One      │
│ review per product per buyer.   │
│                                 │
│ (No review form)                │
│ (Your review shows above)       │
└─────────────────────────────────┘

─────────────────────────────────────

STEP 4: ORDER MOVES TO COMPLETED
       (Later, buyer completes order)
┌─────────────────────────────────┐
│ Tracking Page                   │
│ Order: Tomato (RECEIVED 🔵)     │
│ [Order marked as completed]     │
└─────────────────────────────────┘
           ↓
    Status: COMPLETED 🟢
           ↓
    Product Page Still Shows:
    ✅ "Already reviewed"
    ❌ No review form
           ↓
┌─────────────────────────────────┐
│ Product Page (COMPLETED)        │
│                                 │
│ ✅ Thank you! You have already  │
│ reviewed this product.          │
│                                 │
│ (Your review still visible)     │
│ (No review form)                │
└─────────────────────────────────┘
```

---

## 🚫 Scenarios Where Review NOT Allowed

### Scenario 1: Order Still ACTIVE
```
┌─────────────────────────────────┐
│ Order: Tomato (ACTIVE 🟡)       │
│                                 │
│ 📦 You can leave a review while │
│ the product is in RECEIVED      │
│ status.                         │
│                                 │
│ No review form shown            │
└─────────────────────────────────┘
User Action: Try to submit form → Cannot (form hidden)
```

### Scenario 2: Order Cancelled
```
┌─────────────────────────────────┐
│ Order: Tomato (CANCELLED ⚪)    │
│                                 │
│ 📦 You can leave a review while │
│ the product is in RECEIVED      │
│ status.                         │
│                                 │
│ No review form shown            │
└─────────────────────────────────┘
User Action: Try to submit form → Cannot (form hidden)
```

### Scenario 3: Already Reviewed
```
First review submitted ✅
│
Order status: RECEIVED 🔵
│
┌─────────────────────────────────┐
│ ✅ Thank you! You have already  │
│ reviewed this product. One      │
│ review per product per buyer.   │
│                                 │
│ No review form shown            │
└─────────────────────────────────┘
User Action: Try to submit form → Cannot (form hidden)
            Try to force submit → Error message shown
```

---

## 📊 Review Permission Matrix

| Status | Can Review? | Form Shown? | Message |
|--------|-------------|-------------|---------|
| ACTIVE | ❌ No | No | "Leave review when RECEIVED" |
| RECEIVED | ✅ Yes (first time) | Yes | Review form |
| RECEIVED | ❌ No (if reviewed) | No | "Already reviewed" |
| COMPLETED | ❌ No | No | "Already reviewed" |
| CANCELLED | ❌ No | No | "Leave review when RECEIVED" |

---

## ✅ What's Now Protected

```
✅ Cannot review before receiving order
✅ Cannot review after completing order
✅ Cannot review same product twice
✅ Cannot submit multiple reviews via form
✅ Cannot submit multiple reviews via API/manual
✅ Clear error messages for each scenario
✅ Frontend + Backend logic aligned
```

---

## 🎯 User Journey Map

```
Make Reservation
    ↓
ACTIVE (waiting)
    ├─ No review form shown ❌
    ├─ Message: "Wait for received status"
    └─ Can cancel order
         ↓
Mark as Received
    ↓
RECEIVED (review window open!)
    ├─ Review form shown ✅
    ├─ Can write review
    ├─ Can upload photo
    └─ Can submit review
         ↓
Review Submitted ✅
    ↓
RECEIVED (review window closed)
    ├─ Form hidden ❌
    ├─ Message: "Already reviewed"
    └─ Can see own review
         ↓
Complete Order
    ↓
COMPLETED
    ├─ Form still hidden ❌
    ├─ Review still visible ✅
    └─ Order marked done
```

---

## 💡 Key Points

✅ **Review Window:** Only when status = RECEIVED  
✅ **One Review Only:** Per user per product  
✅ **Clear Messaging:** Tells users why form is/isn't shown  
✅ **Backend Check:** Backend also validates (can't bypass)  
✅ **User Friendly:** Logical flow, no confusion  

---

## 🧪 Quick Test

```
1. Reserve product          → Status: ACTIVE
2. Check product page       → No review form ❌
3. Mark as received         → Status: RECEIVED
4. Check product page       → Review form shown ✅
5. Write & submit review    → Status: RECEIVED (updated)
6. Check product page       → No review form ❌
                            → "Already reviewed" message
7. Complete order          → Status: COMPLETED
8. Check product page       → Still no review form ❌
                            → Your review visible ✅
```

**All tests pass = System working correctly!** ✅

