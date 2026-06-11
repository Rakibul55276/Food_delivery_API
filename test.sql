-- =========================================
-- FOOD DELIVERY TEST DATA
-- =========================================

SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE carts;
TRUNCATE TABLE food_items;
TRUNCATE TABLE categories;
TRUNCATE TABLE restaurants;

SET FOREIGN_KEY_CHECKS = 1;

-- =========================================
-- RESTAURANT
-- =========================================

INSERT INTO restaurants (
    id,
    user_id,
    name,
    description,
    phone,
    address,
    latitude,
    longitude,
    is_active,
    created_at,
    updated_at
)
VALUES (
    1,
    1,
    'Pizza Hut',
    'Best pizza and burgers in town',
    '0500000000',
    'Jubail, Saudi Arabia',
    24.71360000,
    46.67530000,
    1,
    NOW(),
    NOW()
);

-- =========================================
-- CATEGORIES
-- =========================================

INSERT INTO categories (
    id,
    restaurant_id,
    name,
    created_at,
    updated_at
)
VALUES
(1,1,'Pizza',NOW(),NOW()),
(2,1,'Burger',NOW(),NOW()),
(3,1,'Drinks',NOW(),NOW());

-- =========================================
-- FOOD ITEMS
-- =========================================

INSERT INTO food_items (
    id,
    restaurant_id,
    category_id,
    name,
    description,
    price,
    discount_price,
    is_available,
    created_at,
    updated_at
)
VALUES

(
    1,
    1,
    1,
    'Chicken Pizza',
    'Large chicken pizza',
    25.00,
    20.00,
    1,
    NOW(),
    NOW()
),

(
    2,
    1,
    1,
    'Cheese Pizza',
    'Large cheese pizza',
    22.00,
    NULL,
    1,
    NOW(),
    NOW()
),

(
    3,
    1,
    2,
    'Beef Burger',
    'Juicy beef burger',
    15.00,
    12.00,
    1,
    NOW(),
    NOW()
),

(
    4,
    1,
    3,
    'Coca Cola',
    'Cold soft drink',
    5.00,
    NULL,
    1,
    NOW(),
    NOW()
);

-- =========================================
-- CART
-- =========================================

INSERT INTO carts (
    id,
    user_id,
    food_item_id,
    quantity,
    price,
    created_at,
    updated_at
)
VALUES
(
    1,
    1,
    1,
    2,
    20.00,
    NOW(),
    NOW()
);

-- =========================================
-- END
-- =========================================