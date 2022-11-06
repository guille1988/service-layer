<?php


namespace Felipetti\ServiceLayer\Data;


use Felipetti\ServiceLayer\Helper\StringHelper;


final class Data
{

    // Has the config name.
    protected string $configFileName = 'service_layer.php';

    // Contains the name of the service stub.
    protected string $stubFileName = 'Service.stub';

    // Has the path of the published config.
    protected string $publishConfigPath;

    // Contains the path of the source config.
    protected string $sourceConfigPath;

    // Has the path of the published stub.
    protected string $publishStubPath;

    // Contains the path of the source stub.
    protected string $sourceStubPath;

    // Contains the active stub, published or not.
    protected string $stub;

    // Contains the active config, published or not
    protected array $config;


    /**
     * Sets all the attributes needed to initiate the data class.
     *
     */
    public function __construct()
    {
        $this->publishConfigPath = 'config/' . $this->configFileName;
        $this->sourceConfigPath = dirname(__FILE__, 2) . '/' . ucfirst($this->publishConfigPath);
        $this->config = include(StringHelper::getProperPath($this->publishConfigPath, $this->sourceConfigPath));

        $stubFolderPath = $this->config['stub_folder_path'];
        $stubFolderPathChecked = empty($stubFolderPath) ? base_path('stub') : $stubFolderPath;

        $this->publishStubPath = $stubFolderPathChecked . '/' . $this->stubFileName;
        $this->sourceStubPath = dirname(__FILE__, 2) . '/Stub/' . $this->stubFileName;

        $this->stub = StringHelper::getProperPath($this->publishStubPath, $this->sourceStubPath);
    }


    /**
     * Gets the config file name.
     *
     * @return string
     */
    public function getConfigFileName(): string
    {
        return $this->configFileName;
    }


    /**
     * Gets the path of the source config.
     *
     * @return string
     */
    public function getSourceConfigPath(): string
    {
        return $this->sourceConfigPath;
    }


    /**
     * Gets the path of the published stub.
     *
     * @return string
     */
    public function getPublishStubPath(): string
    {
        return $this->publishStubPath;
    }


    /**
     * Gets the path of the source stub.
     *
     * @return string
     */
    public function getSourceStubPath(): string
    {
        return $this->sourceStubPath;
    }


    /**
     * Gets the active config, whether is published or not.
     *
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }


    /**
     * Gets the active stub, whether is published or not.
     *
     * @return string
     */
    public function getStub(): string
    {
        return $this->stub;
    }
}
