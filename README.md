PHP SWF
=======

A wrapper around the events in a workflow execution.

## Usage ##

This library would normally be used in conjunction with the
AWS SWF library. For example, here is how you would fetch a
workflow execution history from AWS and use this library:

```php
$client = \Aws\Swf\SwfClient::factory([
  'key' => 'my_aws_key',
  'secret' => 'my_aws_secret',
  'region' => 'my_aws_region',
]);
$result = $client->getWorkflowExecutionHistory([
  'domain' => 'swf_domain_name',
  'execution' => [
    'workflowId' => 'WorkflowId',
    'runId' => 'runid',
  ]
]);
$events = new \Swf\WorkflowEvents($result->get('events'));

// now use the object to ease the task of parsing
// the event history
$event = $events->getWorkflowStartedEvent();
```

## Running unit tests ##

From this directory:

```bash
phpunit --bootstrap=test/bootstrap.php test/
```
