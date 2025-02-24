@servers(['main' => ['deploy@petramsphere.com']])

@task('list', ['on' => 'main'])
    cd /var/www/html/petramsphere.com
    ls
@endtask

<!-- https://discord.com/api/webhooks/1343399677697065022/bNdQZFW5YSxIqZaCiz7mbA6la5vfjSPX0O1i2ken3YyC7qWIilugV1uP_c1WKN0s-8pG -->