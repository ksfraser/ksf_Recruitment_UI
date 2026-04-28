<?php
/**
 * Recruitment Dashboard
 */

$page_security = 'SA_RECRUITMENT';
$path_to_root = "../../..";

include_once($path_to_root . "/includes/session.inc");
include_once($path_to_root . "/includes/ui.inc");
include_once($path_to_root . "/modules/FA_Recruitment/includes/recruitment_db.inc");

page(_("Recruitment"), false, false, "", "");

$section = isset($_GET['section']) ? $_GET['section'] : 'jobs';

switch ($section) {
    case 'applications':
        $job_id = isset($_GET['job_id']) ? $_GET['job_id'] : 0;
        display_applications($job_id);
        break;
    case 'jobs':
    default:
        display_job_openings();
        break;
}

end_page(true);

function display_job_openings(): void
{
    $jobs = get_job_openings();
    
    start_table(TABLESTYLE);
    table_header([_('Title'), _('Type'), _('Department'), _('Status'), _('Applications')]);
    
    while ($job = db_fetch($jobs)) {
        alt_table_row($job);
        $link = "?section=applications&job_id=" . $job['id'];
        label_cell("<a href='$link'>" . $job['title'] . "</a>");
        label_cell($job['type']);
        label_cell($job['department'] ?? '-');
        label_cell($job['status']);
        $stats = get_job_statistics($job['id']);
        label_cell(array_sum($stats));
    }
    end_table(1);
}

function display_applications(int $job_id): void
{
    $applications = get_applications(['job_id' => $job_id]);
    
    start_table(TABLESTYLE);
    table_header([_('Name'), _('Email'), _('Status'), _('Rating'), _('Action')]);
    
    while ($app = db_fetch($applications)) {
        alt_table_row($app);
        label_cell($app['first_name'] . ' ' . $app['last_name']);
        label_cell($app['email']);
        label_cell($app['status']);
        label_cell($app['rating'] ? str_repeat('★', $app['rating']) : '-');
        echo "<td><a href='?update_status=" . $app['id'] . "'>" . _("Update Status") . "</a></td>";
    }
    end_table(1);
}