public function up(): void
{
    Schema::table('desains', function (Blueprint $table) {
        $table->text('mockup_url')->nullable()->after('html_kemasan');
    });
}

public function down(): void
{
    Schema::table('desains', function (Blueprint $table) {
        $table->dropColumn('mockup_url');
    });
}