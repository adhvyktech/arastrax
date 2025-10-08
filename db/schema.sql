-- db/schema.sql

CREATE TABLE orgs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    owner_id INT,
    logo VARCHAR(255),
    status ENUM('active','archived','deleted') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    name VARCHAR(255),
    plan_id INT,
    org_id INT,
    role ENUM('admin','member','read','analytics') DEFAULT 'member',
    status ENUM('active','invited','suspended','deleted') DEFAULT 'active',
    verified BOOLEAN DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    features JSON,
    quotas JSON,
    price DECIMAL(10,2) DEFAULT 0,
    status ENUM('active','archived') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    org_id INT,
    creator_id INT,
    name VARCHAR(255),
    description TEXT,
    status ENUM('draft','published','archived','deleted') DEFAULT 'draft',
    plan_id INT,
    published_url VARCHAR(255),
    is_public BOOLEAN DEFAULT 1,
    password VARCHAR(255),
    analytics_enabled BOOLEAN DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE assets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT,
    org_id INT,
    uploader_id INT,
    type ENUM('image','video','model','audio','gif') NOT NULL,
    url VARCHAR(255),
    metadata JSON,
    status ENUM('active','deleted','flagged') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE analytics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT,
    event VARCHAR(100),
    data JSON,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    target_user INT,
    message VARCHAR(255),
    type VARCHAR(50),
    is_read BOOLEAN DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    level VARCHAR(20),
    message TEXT,
    user_id INT,
    org_id INT,
    context JSON,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    org_id INT,
    user_id INT,
    role ENUM('admin','member','read','analytics') DEFAULT 'member',
    invited_by INT,
    status ENUM('active', 'invited', 'removed') DEFAULT 'active',
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
