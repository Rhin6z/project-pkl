<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Trigger untuk update email guru ketika email user berubah
        DB::unprepared('
            CREATE TRIGGER after_user_email_update_guru
            AFTER UPDATE ON users
            FOR EACH ROW
            BEGIN
                IF OLD.email != NEW.email THEN
                    UPDATE gurus
                    SET email = NEW.email
                    WHERE email = OLD.email;
                END IF;
            END;
        ');

        // Trigger untuk update email siswa ketika email user berubah
        DB::unprepared('
            CREATE TRIGGER after_user_email_update_siswa
            AFTER UPDATE ON users
            FOR EACH ROW
            BEGIN
                IF OLD.email != NEW.email THEN
                    UPDATE siswas
                    SET email = NEW.email
                    WHERE email = OLD.email;
                END IF;
            END;
        ');


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_user_email_update_guru');
        DB::unprepared('DROP TRIGGER IF EXISTS after_user_email_update_siswa');

    }
};
