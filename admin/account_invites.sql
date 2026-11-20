CREATE TABLE IF NOT EXISTS admin_account_invites (
    admin_id INT NOT NULL,
    token_hash CHAR(64) NOT NULL UNIQUE,
    invited_by INT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    expires_at DATETIME NOT NULL,
    PRIMARY KEY (admin_id),
    INDEX idx_admin_account_invites_expiry (expires_at),
    CONSTRAINT fk_admin_account_invites_admin
        FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE CASCADE,
    CONSTRAINT fk_admin_account_invites_inviter
        FOREIGN KEY (invited_by) REFERENCES admins(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
