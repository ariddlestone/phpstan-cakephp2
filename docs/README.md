# Available Extensions

## MVC Extensions

PHPStan extensions are available for several MVC classes in CakePHP to help PHPStan understand the otherwise
undocumented methods and properties of these classes.

```mermaid
classDiagram
    namespace CakePHP {
        class Shell {
            <<abstract>>
            string[] tasks
            string[] uses
        }
        class Model {
            <<abstract>>
            string[] actsAs
            array hasOne
            array hasMany
            array belongsTo
            array hasAndBelongsToMany
            array findMethods
            array mapMethods
        }
        class Behavior {
            <<abstract>>
        }
        class Controller {
            <<abstract>>
            string[] components
            string[] helpers
            string[] uses
        }
        class Component {
            <<abstract>>
            string[] components
        }
        class Helper {
            <<abstract>>
            string[] helpers
        }
    }
    namespace App {
        class AppShell {
            <<abstract>>
        }
        class AppModel {
            <<abstract>>
        }
        class AppController {
            <<abstract>>
        }
        class AppHelper {
            <<abstract>>
        }
    }
    AppShell --|> Shell
    Shell --> "*" Shell
    Shell --> "*" Model
    
    AppModel --|> Model
    Model --> "*" Behavior
    
    AppController --|> Controller
    Controller --> "*" Model
    Controller --> "*" Component
    Controller --> "*" Helper
    Component --> "*" Component
    
    AppHelper --|> Helper
    Helper --> "*" Helper
    
    click Component href "Components.md" "See PHPStan customizations for Components"
    click Controller href "Controllers.md" "See PHPStan customizations for Controllers"
    click Helper href "Helpers.md" "See PHPStan customizations for Helpers"
    click Model href "Models.md" "See PHPStan customizations for Models"
    click Shell href "Shells.md" "See PHPStan customizations for Shells"
```
