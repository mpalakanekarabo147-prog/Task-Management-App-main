<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar_path')->nullable()->after('role');
            $table->boolean('deadline_reminder_emails')->default(true)->after('avatar_path');
            $table->boolean('task_assignment_notifications')->default(true)->after('deadline_reminder_emails');
            $table->boolean('status_update_alerts')->default(true)->after('task_assignment_notifications');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'avatar_path',
                'deadline_reminder_emails',
                'task_assignment_notifications',
                'status_update_alerts',
            ]);
        });
    }
};
