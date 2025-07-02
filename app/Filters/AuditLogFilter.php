<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\AuditLogModel;

class AuditLogFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Optionally: capture “old_data” here (e.g. DB state before a change)
        // and stash it in the request or a shared service for later.
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $session = session();
        $userId  = $session->get('userId') ?? null;

        // Determine “action” (HTTP verb + URI)
        $action = strtoupper($request->getMethod())
                . ' ' 
                . $request->getURI()->getPath();

        // Determine target table & ID (if RESTful, the first segment is the resource)
        $segments   = $request->getURI()->getSegments();
        $targetTable = $segments[0] ?? null;

        // If it’s a resource with an ID, the next segment is the ID
        $targetId = isset($segments[1]) && is_numeric($segments[1])
                  ? (int) $segments[1]
                  : null;

        // We’re not capturing old/new JSON in this simple example:
        $oldData = null;
        $newData = null;

        $model = new AuditLogModel();
        $model->insert([
            'user_id'      => $userId,
            'action'       => $action,
            'target_table' => $targetTable,
            'target_id'    => $targetId,
            'old_data'     => $oldData,
            'new_data'     => $newData,
            'ip_address'   => $request->getIPAddress(),
            // 'created_at' will be auto-set by the DB default if you have one
        ]);
    }
}
