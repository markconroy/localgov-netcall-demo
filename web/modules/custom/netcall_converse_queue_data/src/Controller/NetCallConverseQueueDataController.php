<?php

namespace Drupal\netcall_converse_queue_data\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

class NetCallConverseQueueDataController extends ControllerBase {

  /**
   * Fetch data and render listing.
   */
  public function listing() {
    $module_path = \Drupal::service('extension.list.module')->getPath('netcall_converse_queue_data');
    $csv_path = $module_path . '/sample-data/data.csv';
    $csv_data = array_map('str_getcsv', file($csv_path));

    // Remove BOM from the first header if present
    $headers = array_map('trim', array_shift($csv_data));
    if (isset($headers[0])) {
      $headers[0] = preg_replace('/^\x{FEFF}/u', '', $headers[0]);
    }

    $json_data = json_encode(array_map(function($row) use ($headers) {
      return array_combine($headers, array_map('trim', $row));
    }, $csv_data));
    $data = json_decode($json_data, true);

    $rows = [];
    foreach ($data as $record) {
      $rows[] = [
        'data' => [
          $record['Queue'] ?? '',
          $record['Total Calls Queued'] ?? '',
          $record['Direct Calls Queued'] ?? '',
          $record['Transferred Calls Queued'] ?? '',
          $record['Calls Answered'] ?? '',
          $record['Calls Answered (%)'] ?? '',
          $record['Calls Abandoned'] ?? '',
          $record['Calls Abandoned (%)'] ?? '',
          $record['Calls Redirected'] ?? '',
          $record['Calls Redirected (%)'] ?? '',
          $record['CallBacks Handled'] ?? '',
          $record['CallBacks Handled (%)'] ?? '',
          $record['CallBacks Rejected'] ?? '',
          $record['CallBacks Rejected (%)'] ?? '',
          $record['Total Time To Answer'] ?? '',
          $record['Avg. Time To Answer'] ?? '',
          $record['Longest Time To Answer'] ?? '',
          $record['Total Abandonment'] ?? '',
          $record['Avg. Abandonment'] ?? '',
          $record['Longest Abandonment'] ?? '',
          $record['Outbound Calls Attempted'] ?? '',
          $record['Outbound Calls Answered'] ?? '',
          $record['Outbound Calls Answered (%)'] ?? '',
          $record['Calls Transferred'] ?? '',
          $record['Calls Transferred (%)'] ?? '',
          $record['Total Connected Call Duration'] ?? '',
          $record['Avg. Connected Call Duration'] ?? '',
          $record['Total Wrap-up Duration'] ?? '',
          $record['Avg. Wrap-up Duration'] ?? '',
          $record['Total Emails Queued'] ?? '',
          $record['Direct Emails Queued'] ?? '',
          $record['Transferred Emails Queued'] ?? '',
          $record['Inbound Emails Processed'] ?? '',
          $record['Inbound Emails Replied'] ?? '',
          $record['Inbound Emails Replied (%)'] ?? '',
          $record['Inbound Emails Completed'] ?? '',
          $record['Inbound Emails Completed (%)'] ?? '',
          $record['Inbound Emails Deleted'] ?? '',
          $record['Inbound Emails Deleted (%)'] ?? '',
          $record['Inbound Emails Transferred'] ?? '',
          $record['Inbound Emails Transferred (%)'] ?? '',
          $record['Total Inbound Email Handling Time'] ?? '',
          $record['Avg. Inbound Email Handling Time'] ?? '',
          $record['Longest Inbound Email Handling Time'] ?? '',
          $record['Avg. Inbound Email Total Time In System'] ?? '',
          $record['Total Inbound Email Total Time In System'] ?? '',
          $record['Outbound Emails Started'] ?? '',
          $record['Outbound Emails Sent'] ?? '',
          $record['Outbound Emails Sent (%)'] ?? '',
          $record['Outbound Emails Deleted'] ?? '',
          $record['Outbound Emails Deleted (%)'] ?? '',
          $record['Longest Outbound Email Duration'] ?? '',
          $record['Total Outbound Email Duration'] ?? '',
          $record['Avg. Outbound Email Duration'] ?? '',
          $record['Total Email Wrap-up Duration'] ?? '',
          $record['Avg. Email Wrap-up Duration'] ?? '',
          $record['Email Group SLA 1 Within SLA'] ?? '',
          $record['Email Group SLA 1 Over SLA'] ?? '',
          $record['Email Group SLA 1 %'] ?? '',
          $record['Email Group SLA 1 Target %'] ?? '',
          $record['Email Group SLA 2 Within SLA'] ?? '',
          $record['Email Group SLA 2 Over SLA'] ?? '',
          $record['Email Group SLA 2 %'] ?? '',
          $record['Email Group SLA 2 Target %'] ?? '',
          $record['Email Queue SLA 1 Within SLA'] ?? '',
          $record['Email Queue SLA 1 Over SLA'] ?? '',
          $record['Email Queue SLA 1 %'] ?? '',
          $record['Email Queue SLA 1 Target %'] ?? '',
          $record['Email Queue SLA 2 Within SLA'] ?? '',
          $record['Email Queue SLA 2 Over SLA'] ?? '',
          $record['Email Queue SLA 2 %'] ?? '',
          $record['Email Queue SLA 2 Target %'] ?? '',
          $record['Total Messaging Queued'] ?? '',
          $record['Direct Messaging Queued'] ?? '',
          $record['Transferred Messaging Queued'] ?? '',
          $record['Messaging Completed'] ?? '',
          $record['Messaging Completed (%)'] ?? '',
          $record['Messaging Pended'] ?? '',
          $record['Messaging Pended (%)'] ?? '',
          $record['Messaging Deleted'] ?? '',
          $record['Messaging Deleted (%)'] ?? '',
          $record['Messaging Transferred'] ?? '',
          $record['Messaging Transferred (%)'] ?? '',
          $record['Avg. Messaging Time To Answer'] ?? '',
          $record['Longest Messaging Time to Answer'] ?? '',
          $record['Total Messaging Time to Answer'] ?? '',
          $record['Total Connected Messaging Duration'] ?? '',
          $record['Avg. Connected Messaging Duration'] ?? '',
          $record['Outbound Messaging Started'] ?? '',
          $record['Outbound Messaging Completed'] ?? '',
          $record['Outbound Messaging Completed (%)'] ?? '',
          $record['Outbound Messaging Pended'] ?? '',
          $record['Outbound Messaging Pended (%)'] ?? '',
          $record['Outbound Messaging Deleted'] ?? '',
          $record['Outbound Messaging Deleted (%)'] ?? '',
          $record['Outbound Messaging Transferred'] ?? '',
          $record['Outbound Messaging Transferred (%)'] ?? '',
          $record['Total Outbound Messaging Duration'] ?? '',
          $record['Avg. Outbound Messaging Duration'] ?? '',
          $record['Avg. Messaging Wrap-up Duration'] ?? '',
          $record['Total Messaging Wrap-up Duration'] ?? '',
          $record['Total Tasks Queued'] ?? '',
          $record['Direct Tasks Queued'] ?? '',
          $record['Transferred Tasks Queued'] ?? '',
          $record['Tasks Completed'] ?? '',
          $record['Tasks Completed (%)'] ?? '',
          $record['Tasks Deleted'] ?? '',
          $record['Tasks Deleted (%)'] ?? '',
          $record['Tasks Transferred'] ?? '',
          $record['Tasks Transferred (%)'] ?? '',
          $record['Avg. Task Time To Answer'] ?? '',
          $record['Longest Task Time to Answer'] ?? '',
          $record['Total Task Time to Answer'] ?? '',
          $record['Total Connected Task Duration'] ?? '',
          $record['Avg. Connected Task Duration'] ?? '',
          $record['Avg. Task Wrap-up Duration'] ?? '',
          $record['Total Task Wrap-up Duration'] ?? '',
        ],
      ];
    }

    return [
      '#type' => 'table',
      '#header' => [
        'Queue', 'Total Calls Queued', 'Direct Calls Queued', 'Transferred Calls Queued', 'Calls Answered', 'Calls Answered (%)', 'Calls Abandoned', 'Calls Abandoned (%)', 'Calls Redirected', 'Calls Redirected (%)', 'CallBacks Handled', 'CallBacks Handled (%)', 'CallBacks Rejected', 'CallBacks Rejected (%)', 'Total Time To Answer', 'Avg. Time To Answer', 'Longest Time To Answer', 'Total Abandonment', 'Avg. Abandonment', 'Longest Abandonment', 'Outbound Calls Attempted', 'Outbound Calls Answered', 'Outbound Calls Answered (%)', 'Calls Transferred', 'Calls Transferred (%)', 'Total Connected Call Duration', 'Avg. Connected Call Duration', 'Total Wrap-up Duration', 'Avg. Wrap-up Duration', 'Total Emails Queued', 'Direct Emails Queued', 'Transferred Emails Queued', 'Inbound Emails Processed', 'Inbound Emails Replied', 'Inbound Emails Replied (%)', 'Inbound Emails Completed', 'Inbound Emails Completed (%)', 'Inbound Emails Deleted', 'Inbound Emails Deleted (%)', 'Inbound Emails Transferred', 'Inbound Emails Transferred (%)', 'Total Inbound Email Handling Time', 'Avg. Inbound Email Handling Time', 'Longest Inbound Email Handling Time', 'Avg. Inbound Email Total Time In System', 'Total Inbound Email Total Time In System', 'Outbound Emails Started', 'Outbound Emails Sent', 'Outbound Emails Sent (%)', 'Outbound Emails Deleted', 'Outbound Emails Deleted (%)', 'Longest Outbound Email Duration', 'Total Outbound Email Duration', 'Avg. Outbound Email Duration', 'Total Email Wrap-up Duration', 'Avg. Email Wrap-up Duration', 'Email Group SLA 1 Within SLA', 'Email Group SLA 1 Over SLA', 'Email Group SLA 1 %', 'Email Group SLA 1 Target %', 'Email Group SLA 2 Within SLA', 'Email Group SLA 2 Over SLA', 'Email Group SLA 2 %', 'Email Group SLA 2 Target %', 'Email Queue SLA 1 Within SLA', 'Email Queue SLA 1 Over SLA', 'Email Queue SLA 1 %', 'Email Queue SLA 1 Target %', 'Email Queue SLA 2 Within SLA', 'Email Queue SLA 2 Over SLA', 'Email Queue SLA 2 %', 'Email Queue SLA 2 Target %', 'Total Messaging Queued', 'Direct Messaging Queued', 'Transferred Messaging Queued', 'Messaging Completed', 'Messaging Completed (%)', 'Messaging Pended', 'Messaging Pended (%)', 'Messaging Deleted', 'Messaging Deleted (%)', 'Messaging Transferred', 'Messaging Transferred (%)', 'Avg. Messaging Time To Answer', 'Longest Messaging Time to Answer', 'Total Messaging Time to Answer', 'Total Connected Messaging Duration', 'Avg. Connected Messaging Duration', 'Outbound Messaging Started', 'Outbound Messaging Completed', 'Outbound Messaging Completed (%)', 'Outbound Messaging Pended', 'Outbound Messaging Pended (%)', 'Outbound Messaging Deleted', 'Outbound Messaging Deleted (%)', 'Outbound Messaging Transferred', 'Outbound Messaging Transferred (%)', 'Total Outbound Messaging Duration', 'Avg. Outbound Messaging Duration', 'Avg. Messaging Wrap-up Duration', 'Total Messaging Wrap-up Duration', 'Total Tasks Queued', 'Direct Tasks Queued', 'Transferred Tasks Queued', 'Tasks Completed', 'Tasks Completed (%)', 'Tasks Deleted', 'Tasks Deleted (%)', 'Tasks Transferred', 'Tasks Transferred (%)', 'Avg. Task Time To Answer', 'Longest Task Time to Answer', 'Total Task Time to Answer', 'Total Connected Task Duration', 'Avg. Connected Task Duration', 'Avg. Task Wrap-up Duration', 'Total Task Wrap-up Duration'
      ],
      '#header_attributes' => [
        'class' => ['netcall-converse-queue-data-table'],
      ],
      '#sticky' => TRUE,
      '#rows' => $rows,
      '#attached' => [
        'library' => [
          'netcall_converse_queue_data/netcall-converse-queue-data',
        ],
      ],
      '#attributes' => [
        'class' => ['netcall-converse-queue-data-table'],
      ],
      '#title' => $this->t('NetCall Converse Queue Data'),

    ];
  }

  /**
   * Fetch and display trends data.
   */
  public function trends() {
    // Call the function to fetch data from the Netcall Converse endpoint.
    $data = netcall_converse_queue_data_fetch_data_trends();
    if (empty($data)) {
      $settings_page = Link::fromTextAndUrl(
        $this->t('settings page'),
        Url::fromRoute('netcall_converse_queue_data.settings')
      )->toString();

      return [
        '#markup' => $this->t('No data available from the Netcall Converse endpoint. Please check your API Key and URL Endpoint on the @settings_page.', [
          '@settings_page' => $settings_page,
        ]),
      ];
    }

    // Process the data and prepare rows for rendering.
    $rows = [];
    foreach ($data['data']['report'] as $record) {
      $rows[] = [
        'data' => [
          $record['ActivityCode'] ?? '',
          $record['TotalTaken'] ?? '',
          $record['TotalTakenPercent'] ?? '',
          $record['TotalDuration'] ?? '',
          $record['TotalDurationPercent'] ?? '',
          $record['EmailsTaken'] ?? '',
          $record['EmailsTakenPercent'] ?? '',
          $record['EmailsDuration'] ?? '',
          $record['EmailsDurationPercent'] ?? '',
          $record['MessagesTaken'] ?? '',
          $record['MessagesTakenPercent'] ?? '',
          $record['MessagesDuration'] ?? '',
          $record['MessagesDurationPercent'] ?? '',
          $record['JobsTaken'] ?? '',
          $record['JobsTakenPercent'] ?? '',
          $record['JobsDuration'] ?? '',
          $record['JobsDurationPercent'] ?? '',
        ],
      ];
    }

    // Define the table header.
    $header = [
      $this->t('Activity Code'),
      $this->t('Total Taken'),
      $this->t('Total Taken %'),
      $this->t('Total Duration'),
      $this->t('Total Duration %'),
      $this->t('Emails Taken'),
      $this->t('Emails Taken %'),
      $this->t('Emails Duration'),
      $this->t('Emails Duration %'),
      $this->t('Messages Taken'),
      $this->t('Messages Taken %'),
      $this->t('Messages Duration'),
      $this->t('Messages Duration %'),
      $this->t('Jobs Taken'),
      $this->t('Jobs Taken %'),
      $this->t('Jobs Duration'),
      $this->t('Jobs Duration %'),
    ];

    // Render the table.
    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#attributes' => [
        'class' => ['netcall-converse-queue-data-trends-table'],
      ],
      '#sticky' => TRUE,
    ];
  }
}
