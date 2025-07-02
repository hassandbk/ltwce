#!/usr/bin/env python3
import os

# Base paths
folders = {
    'Controllers': [
        'AuthController',
        'MemberController',
        'LoanController',
        'SavingsController',
        'ShareController',
        'AccountingController',
        'NotificationAdminController',
        'ConsentController',
        'AssetController',
        'ExpenseController',
    ],
    'Models/Lookup': [
        'FrequencyModel',
        'ChannelModel',
        'EventTypeModel',
        'NotificationStatusModel',
        'ContactTypeModel',
        'MaritalStatusModel',
        'GenderModel',
        'MemberStatusModel',
        'LoanStatusModel',
        'PaymentTypeModel',
        'PaymentMethodModel',
        'ScheduleStatusModel',
        'ExpenseCategoryModel',
    ],
    'Models': [
        'RoleModel',
        'UserModel',
        'PermissionModel',
        'MemberModel',
        'ContactModel',
        'NextOfKinModel',
        'EmploymentModel',
        'FinancialCommitModel',
        'GroupModel',
        'FieldOfficerModel',
        'FieldOfficerGroupModel',
        'LoanModel',
        'LoanPaymentModel',
        'LoanScheduleModel',
        'DocumentLoanModel',
        'SavingsModel',
        'DocumentSavingsModel',
        'ShareModel',
        'DocumentShareModel',
        'GLModuleModel',
        'COAModel',
        'AccountingEntryModel',
        'AuditLogModel',
        'NotificationRuleModel',
        'MemberConsentModel',
        'NotificationModel',
        'AssetModel',
        'ExpenseModel',
        'DocumentExpenseModel',
    ],
    'Services': [
        'AuthService',
        'LoanService',
        'AccountingService',
        'NotificationService',
        'AuditService',
        'AssetService',
    ],
    'Helpers': [
        'auth_helper',
        'date_helper',
        'notification_helper',
        'file_helper',
    ],
}

# Boilerplate templates
boilerplates = {
    'Controller': """<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class {name} extends Controller
{{
    public function index()
    {{
        // TODO: implement
    }}
}}
""",
    'Model': """<?php

namespace App\Models;

use CodeIgniter\Model;

class {name} extends Model
{{
    protected $table      = '{table}';
    protected $primaryKey = '{pk}';
    // TODO: add $allowedFields, relationships, etc.
}}
""",
    'Service': """<?php

namespace App\Services;

class {name}
{{
    // TODO: implement
}}
""",
    'Helper': """<?php

// app/Helpers/{name}.php

if (! function_exists('{func_prefix}_example')) {{
    function {func_prefix}_example()
    {{
        // TODO: implement
    }}
}}
""",
}

def create_file(path, content):
    with open(path, 'w') as f:
        f.write(content)
    print(f"Created {path}")

def main():
    # Ensure base 'app' directory exists
    if not os.path.isdir('app'):
        os.makedirs('app')
    os.chdir('app')

    for folder, items in folders.items():
        # Create directory
        os.makedirs(folder, exist_ok=True)
        for item in items:
            # Determine file path
            if folder.startswith('Helpers'):
                filename = f"{item}.php"
                content = boilerplates['Helper'].format(
                    name=item,
                    func_prefix=item.replace('_helper', '')
                )
            elif folder.startswith('Controllers'):
                filename = f"{item}.php"
                content = boilerplates['Controller'].format(name=item)
            elif folder.startswith('Services'):
                filename = f"{item}.php"
                content = boilerplates['Service'].format(name=item)
            else:  # Models or Models/Lookup
                filename = f"{item}.php"
                # derive table name and pk from model name conventionally
                # e.g. MemberModel -> member, pk member_id
                base = item[:-5] if item.endswith('Model') else item
                table = base.lower() + ('s' if not base.lower().endswith('s') else '')
                pk = base.lower() + '_id'
                content = boilerplates['Model'].format(
                    name=item,
                    table=table,
                    pk=pk
                )

            path = os.path.join(folder, filename)
            create_file(path, content)

if __name__ == '__main__':
    main()
