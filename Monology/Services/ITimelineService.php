<?php

namespace Monology\Services
{
    use Monology\Models;

    interface ITimelineService
    {
        function getTimeline(array $params) : array;
        function getStatus(string $statusId) : Models\Status;
        function createStatus(string $body) : void;
        function deleteStatus(string $statusId) : void;
    }
}

?>