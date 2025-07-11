
-- ======================================================================
-- TABLE: LOCATIONS
-- This table stores information about various locations (districts) where open positions are available.
-- ======================================================================

CREATE TABLE `locations` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each location
    `district_name` VARCHAR(255) NOT NULL,  -- Name of the district
    `description` TEXT NOT NULL,  -- Detailed description of the location
    `contact_id` BIGINT(20) DEFAULT NULL,  -- Foreign key to the contact table (replacing contact_email and contact_phone)
    `image` VARCHAR(255) DEFAULT NULL,  -- Optional image for the location
    `icon_path` TEXT DEFAULT NULL,  -- Optional icon for use (e.g., on maps)
    `icon_width` INT UNSIGNED DEFAULT 62,  -- Width of the icon
    `icon_height` INT UNSIGNED DEFAULT 61,  -- Height of the icon
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Creation timestamp
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Update timestamp
    INDEX (`district_name`),  -- Index for faster searches by district
    FOREIGN KEY (`contact_id`) REFERENCES `contact`(`contact_id`) ON DELETE SET NULL  -- Foreign key constraint
);
-- ======================================================================
-- TABLE: ROLE to be updated
-- This table stores roles that can be assigned to open positions.
-- ======================================================================

CREATE TABLE `role` (
  `role_id` BIGINT(20) NOT NULL,  -- Unique identifier for each role
  `title` VARCHAR(30) NOT NULL,  -- Title of the role (e.g., 'HR Manager', 'Software Engineer')
  `description` TEXT DEFAULT NULL,  -- Description of the role and responsibilities
  PRIMARY KEY (`role_id`)  -- Primary key for the role table
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- ======================================================================
-- TABLE: OPEN POSITIONS
-- This table stores open job positions linked to specific locations (districts).
-- ======================================================================
CREATE TABLE `open_positions` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each job position
    `role_id` BIGINT(20) NOT NULL,  -- Foreign key to the role table (the role associated with this position)
    `location_id` INT UNSIGNED NOT NULL,  -- Foreign key to locations (districts)
    `requirements` TEXT DEFAULT NULL,  -- Optional job requirements
    `start_date` DATE NOT NULL,  -- The date when the position starts
    `end_date` DATE DEFAULT NULL,  -- The date when the position expires (optional)
    `url` VARCHAR(255) DEFAULT NULL,  -- URL for applying or more information
    `contact_email` VARCHAR(255) DEFAULT NULL,  -- Contact email for the position
    `contact_phone` VARCHAR(50) DEFAULT NULL,  -- Contact phone for the position
    `salary_range` VARCHAR(255) DEFAULT NULL,  -- Salary range for transparency
    `employment_type` ENUM('Full-time', 'Part-time', 'Contract', 'Internship') DEFAULT 'Full-time',  -- Employment type
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Creation timestamp
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Update timestamp
    FOREIGN KEY (`location_id`) REFERENCES `locations`(`id`) ON DELETE CASCADE,  -- Foreign key to locations
    FOREIGN KEY (`role_id`) REFERENCES `role`(`role_id`) ON DELETE CASCADE,  -- Foreign key to the role table
    INDEX (`start_date`)  -- Index for fast searching by start date
);


-- ======================================================================
-- TABLE: POSITION SKILLS
-- This table stores the required skills for each open position.
-- ======================================================================
CREATE TABLE `position_skills` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each skill
    `position_id` INT UNSIGNED NOT NULL,  -- Foreign key to open positions
    `skill_name` VARCHAR(255) NOT NULL,  -- Name of the skill
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Creation timestamp
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Update timestamp
    FOREIGN KEY (`position_id`) REFERENCES `open_positions`(`id`) ON DELETE CASCADE,  -- Foreign key constraint
    INDEX (`skill_name`)  -- Index to search for skills quickly
);

-- ======================================================================
-- TABLE: POSITION CONTACTS  
-- This table stores contacts associated with open positions, allowing for multiple contacts per position.
-- ======================================================================       

CREATE TABLE `position_contacts` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each contact record
    `position_id` INT UNSIGNED NOT NULL,  -- Foreign key to open positions
    `contact_id` BIGINT(20) NOT NULL,  -- Foreign key to the contact table
    `message` TEXT DEFAULT NULL,  -- Optional message for applicants (e.g., special instructions)
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Creation timestamp
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Update timestamp
    FOREIGN KEY (`position_id`) REFERENCES `open_positions`(`id`) ON DELETE CASCADE,  -- Foreign key to open_positions
    FOREIGN KEY (`contact_id`) REFERENCES `contact`(`contact_id`) ON DELETE CASCADE,  -- Foreign key to contact table
    INDEX (`contact_id`)  -- Index for searching contacts by contact_id
);


-- ======================================================================
-- TABLE: CATEGORIES
-- This table stores the categories used to organize articles (e.g., "Microfinance").
-- ======================================================================
CREATE TABLE `article_categories` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each category
    `name` VARCHAR(255) NOT NULL UNIQUE,  -- Category name (e.g., "Microfinance")
    `description` TEXT DEFAULT NULL,  -- Optional description of the category
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp for when the category was created
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  -- Timestamp for when the category was last updated
);
-- ======================================================================
-- TABLE: COMPANIES
-- This table stores company information for video testimonials.
-- ======================================================================
CREATE TABLE `organization` (
    `organization_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each company
    `name` VARCHAR(255) NOT NULL,  -- Name of the company
    `website` VARCHAR(255) DEFAULT NULL,  -- Optional website URL of the company
    `logo_src` VARCHAR(255) DEFAULT NULL,  -- Optional logo image for the company
    `logo_alt` VARCHAR(255) DEFAULT NULL,  -- Alt text for the company's logo
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Creation timestamp
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Last update timestamp
    INDEX (`name`)  -- Index to search companies by name
);

-- ======================================================================
-- TABLE: member to be updated
-- ======================================================================
CREATE TABLE `member` (
  `member_id` bigint(20) NOT NULL,  -- Unique identifier for each member
  `user_id` bigint(20) NOT NULL,  -- Foreign key to the users table (authenticated user)
 `organization_id` INT UNSIGNED DEFAULT NULL,  -- Foreign key to the organization table (company/organization)
  `title` varchar(50) DEFAULT NULL,  -- Title of the member (e
  `surname` varchar(50) NOT NULL,  -- Surname of the member
  `given_name` varchar(50) NOT NULL,  -- Given name of the member
  `other_names` varchar(100) DEFAULT NULL,  -- Other names of the member
  `nin` varchar(20) NOT NULL,  -- National Identification Number
  `card_number` varchar(20) NOT NULL,  -- Member's card number
    `gender` ENUM('Male', 'Female', 'Other') DEFAULT 'Other',  -- Gender of the member (enum type)
  `dob` date DEFAULT NULL,  -- Date of birth
  `marital_status_id` int(11) DEFAULT NULL,  -- Marital status ID
  `tribe` varchar(50) DEFAULT NULL,  -- Tribe
  `religion` varchar(50) DEFAULT NULL,  -- Religion
  `status_id` int(11) NOT NULL,  -- Status ID (Active/Inactive)
  `role` varchar(255) NOT NULL,  -- Role of the member (e.g., Admin, HR, etc.)
  `img_src` VARCHAR(255) DEFAULT NULL,  -- Image URL for the member (profile picture)
  `img_alt` VARCHAR(255) DEFAULT NULL,  -- Alt text for the member's image
   `bio` TEXT DEFAULT NULL,  -- Optional biography for the author
  `delay` INT UNSIGNED DEFAULT 0,  -- Delay for animations (optional)
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),  -- Record creation timestamp
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),  -- Record last updated timestamp
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,  -- Foreign key to the `users` table
  PRIMARY KEY (`member_id`)  -- Primary key on member_id
  FOREIGN KEY (`organization_id`) REFERENCES `organization`(`organization_id`) ON DELETE SET NULL,  -- Foreign key to the organization table
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ======================================================================
-- TABLE: ARTICLES
-- This table stores the articles and their content, metadata, and references to authors and categories.
-- ======================================================================
CREATE TABLE `articles` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each article
    `slug` VARCHAR(255) NOT NULL UNIQUE,  -- URL-friendly identifier (e.g., 'ltwce-sacco-web-portal-launch')
    `title` VARCHAR(255) NOT NULL,  -- Title of the article
    `excerpt` TEXT NOT NULL,  -- Excerpt/summary of the article
    `content` LONGTEXT NOT NULL,  -- Full content of the article (using LONGTEXT for large articles)
    `publish_date` DATE NOT NULL,  -- Date the article was published
    `user_id` INT UNSIGNED NOT NULL,  -- Foreign key to the users table (author)
    `category_id` INT UNSIGNED NOT NULL,  -- Foreign key to the categories table
    `status` ENUM('Draft', 'Published', 'Archived') DEFAULT 'Draft',  -- Article status
    `visibility` ENUM('Public', 'Private') DEFAULT 'Public',  -- Visibility of the article
    `animation_delay` INT UNSIGNED DEFAULT 0,  -- Optional delay for animations (in milliseconds)
    `external_link` VARCHAR(255) DEFAULT NULL,  -- External source link if the article is from an external source
    `created_by` INT UNSIGNED DEFAULT NULL,  -- Optional reference to the user who created the article (admin/editor)
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp for article creation
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Timestamp for last update
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,  -- Foreign key to users table
    FOREIGN KEY (`category_id`) REFERENCES `article_categories`(`id`) ON DELETE CASCADE,  -- Foreign key to categories table
    FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL  -- Optional reference to the user who created the article
);


-- ======================================================================
-- TABLE: ARTICLE_IMAGES
-- This table stores additional images associated with articles (optional, if articles can have multiple images).
-- ======================================================================
CREATE TABLE `article_images` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each image
    `article_id` BIGINT UNSIGNED NOT NULL,  -- Foreign key to the articles table
    `img_src` VARCHAR(255) NOT NULL,  -- Path for the image
    `img_width` INT UNSIGNED DEFAULT 540,  -- Image width (default 540px)
    `img_height` INT UNSIGNED DEFAULT 340,  -- Image height (default 340px)
    `image_url` VARCHAR(255) DEFAULT NULL,  -- Optional main image URL
    `image_alt_text` VARCHAR(255) DEFAULT NULL,  -- Alt text for the main image
    `image_width` INT UNSIGNED DEFAULT 540,  -- Default width of the image (can be resized)
    `image_height` INT UNSIGNED DEFAULT 340,  -- Default height of the image
    FOREIGN KEY (`article_id`) REFERENCES `articles`(`id`) ON DELETE CASCADE  -- Foreign key to articles table
);

-- ======================================================================
-- TABLE: ARTICLES_FEEDBACK
-- This table stores the articles and their content, metadata, and references to authors and categories.
-- ======================================================================
CREATE TABLE `article_feedback` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each feedback entry
    `article_id` BIGINT UNSIGNED NOT NULL,  -- Foreign key to the articles table
    `user_id` BIGINT UNSIGNED NOT NULL,  -- Foreign key to the users table (user providing feedback)
    `message` TEXT NOT NULL,  -- The feedback message provided by the user
     `location` VARCHAR(255) NOT NULL,  -- Location of the user
    `rating` INT UNSIGNED DEFAULT 0,  -- Optional rating for the article (e.g., 1-5 stars)
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp for feedback creation
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Timestamp for last update
    FOREIGN KEY (`article_id`) REFERENCES `articles`(`id`) ON DELETE CASCADE,  -- Foreign key to articles table
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE  -- Foreign key to users table
);



-- ======================================================================
-- TABLE: TAGS
-- This table stores tags that can be associated with articles (optional feature).
-- ======================================================================
CREATE TABLE `tags` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each tag
    `name` VARCHAR(255) NOT NULL UNIQUE  -- Name of the tag (e.g., "Business", "Loans")
);

-- ======================================================================
-- TABLE: ARTICLE_TAGS
-- This table links articles to tags (many-to-many relationship).
-- ======================================================================
CREATE TABLE `article_tags` (
    `article_id` BIGINT UNSIGNED NOT NULL,  -- Foreign key to the articles table
    `tag_id` INT UNSIGNED NOT NULL,  -- Foreign key to the tags table
    PRIMARY KEY (`article_id`, `tag_id`),  -- Composite primary key to ensure unique article-tag pairs
    FOREIGN KEY (`article_id`) REFERENCES `articles`(`id`) ON DELETE CASCADE,  -- Foreign key to articles
    FOREIGN KEY (`tag_id`) REFERENCES `tags`(`id`) ON DELETE CASCADE  -- Foreign key to tags
);

-- ======================================================================
-- TABLE: TESTIMONIALS
-- This table stores testimonials from members, which can be text or video testimonials.
-- ======================================================================

CREATE TABLE `testimonials` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each testimonial
    `testimonial_type` ENUM('Text', 'Video') NOT NULL,  -- Type of testimonial (Text or Video)
    `img_src` VARCHAR(255) DEFAULT NULL,  -- Path to the testimonial image (for text testimonials)
    `img_alt` VARCHAR(255) DEFAULT NULL,  -- Alt text for the image
    `quote` TEXT NOT NULL,  -- Text of the testimonial
    `video_poster` VARCHAR(255) DEFAULT NULL,  -- Poster image for video testimonials
    `testimonial_video_src` VARCHAR(255) DEFAULT NULL,  -- Path to the video file (for video testimonials)
    `member_id` BIGINT(20) NOT NULL,  -- Foreign key to the users table (author of the testimonial)
    
    `delay` INT UNSIGNED DEFAULT 0,  -- Delay for animation effects (optional)
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Creation timestamp
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Last update timestamp
    FOREIGN KEY (`member_id`) REFERENCES `member`(`member_id`) ON DELETE CASCADE,  -- Foreign key to the member table
  
    INDEX (`testimonial_type`),  -- Index for faster searching by testimonial type
);




-- ======================================================================
-- TABLE: TABS
-- This table stores information about the tabs that are used in various parts of the system (e.g., onboarding, reports).
-- ======================================================================
CREATE TABLE `tabs` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each tab
    `label` VARCHAR(255) NOT NULL,  -- Label of the tab (e.g., "Onboarding")
    `delay` INT UNSIGNED DEFAULT 0,  -- Delay for tab's visibility rendering (optional)
    `icon` VARCHAR(255) NOT NULL,  -- Icon for the tab (e.g., FontAwesome class)
    `image_src` VARCHAR(255) DEFAULT NULL,  -- Path to image associated with the tab (optional)
    `image_alt` VARCHAR(255) DEFAULT NULL,  -- Alt text for the image
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Creation timestamp
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Last update timestamp
    INDEX (`label`)  -- Index for faster searching by label
);

-- ======================================================================
-- TABLE: FEATURES
-- This table stores the features of the system (e.g., loan management, document management, etc.).
-- ======================================================================
CREATE TABLE `features` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each feature
    `icon` VARCHAR(255) NOT NULL,  -- Icon class for the feature (e.g., FontAwesome)
    `bg` VARCHAR(255) NOT NULL,  -- Background style class for the feature (e.g., bg-yellow-100)
    `title` VARCHAR(255) NOT NULL,  -- Title of the feature (e.g., "Member Onboarding")
    `description` TEXT NOT NULL,  -- Description of the feature
    `delay` INT UNSIGNED DEFAULT 0,  -- Delay for animation purposes (optional)
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Creation timestamp
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Last update timestamp
    INDEX (`title`)  -- Index for faster searching by feature title
);

-- ======================================================================
-- TABLE: SERVICES
-- This table stores details about services offered by the platform (e.g., Loan Products, API Integration).
-- ======================================================================
CREATE TABLE `services` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each service
    `slug` VARCHAR(255) NOT NULL UNIQUE,  -- Slug for service (used in URLs)
    `title` VARCHAR(255) NOT NULL,  -- Title of the service (e.g., "Loan Management")
    `desc` TEXT NOT NULL,  -- Description of the service
    `img` VARCHAR(255) DEFAULT NULL,  -- Optional image URL for the service
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Creation timestamp
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  -- Last update timestamp
);

-- ======================================================================
-- TABLE: CLIENTS
-- This table stores client details, including their unique IDs and logos.
-- ======================================================================
CREATE TABLE `clients` (
    `id` VARCHAR(255) PRIMARY KEY,  -- Unique identifier for each client (e.g., 'airtel', 'mtn')
    `name` VARCHAR(255) NOT NULL,  -- Client name (e.g., 'Airtel', 'MTN')
    `logo` VARCHAR(255) NOT NULL,  -- Path to the client's logo image
    `delay` INT UNSIGNED NOT NULL,  -- Delay time in milliseconds (e.g., 0, 100, 200)
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Automatically sets the creation time
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  -- Automatically updates the time whenever the record is modified
);

